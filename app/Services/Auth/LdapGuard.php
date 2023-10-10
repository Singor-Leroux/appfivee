<?php

namespace App\Services\Auth;

use \Override;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\UserProvider;
use App\Exceptions\UserDoesNotExistException;
use App\Exceptions\UsernameRequiredException;
use App\Exceptions\InvalidCredentialsException;

class LdapGuard extends SessionGuard
{
  public function __construct(UserProvider $provider, Request $request, Session $session)
  {
    parent::__construct(name: 'ldap', provider: $provider, session: $session, request: $request);
  }

  /**
   * Attempt to authenticate a user using the given credentials.
   *
   * @param  array  $credentials
   * @param  bool  $remember
   * @return bool
   */
  public function attempt(array $credentials = [], $remember = false, $login = true)
  {
    try {
      // Validate that a username and password are provided.
      if (empty($credentials['username']) || empty($credentials['password'])) {
        throw new UsernameRequiredException();
      }

      // LDAP Configuration
      $ldapHost = env('LDAP_HOST', 'chem.loc');
      $ldapDn = env('LDAP_DN', 'CHEM\\') . $credentials['username'];
      $ldapUsername = $credentials['username'];
      $ldapPassword = $credentials['password'];
      // dd($ldapHost, $ldapDn, $ldapPassword);
      // Attempt LDAP authentication.
      $conn = ldap_connect($ldapHost);
      ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);

      if ($conn) {
        // binding to ldap server
        // dd("ldap_dn = $ldapDn, password = " . $credentials['password']);
        $ldapbind = ldap_bind($conn, $ldapDn, $ldapPassword);

        if ($ldapbind) {
          ldap_unbind($conn);

          // If you need to fetch additional user data, you can do it here.

          // Log the user in.
          if ($login) {
            // Retrieve the user from your application's database based on LDAP username.
            $user = User::where('username', $ldapUsername)->first();
            if ($user) {
              $this->login($user, $remember);
              return true;
            } else {
              // throw new UserDoesNotExistException();
              $user = User::create([
                'username' => $ldapUsername,
                // Assuming 'ldap_username' is the column in your database table for storing LDAP usernames
                'password' => Hash::make($ldapPassword),
                // Assuming 'email' is the column in your database table for storing email addresses
                // Add other columns as needed
              ]);
              return true;
            }
          }

        } else {
          throw new InvalidCredentialsException("Identifiants non valides. Veuillez réessayer");
        }
      }
    } catch (UsernameRequiredException $e) {
      return redirect(route('login'))->with(['message', $e->getMessage()]);
    } catch (InvalidCredentialsException $e) {
      return redirect(route('login'))->with(['message', $e->getMessage()]);
    } catch (UserDoesNotExistException $e) {
      return redirect(route('login'))->with(['message', $e->getMessage()]);
    } catch (\ErrorException $e) {
      dd($e->getMessage());
      return redirect(route('login'))->with(['message', $e->getMessage()]);
    } catch (\Exception $e) {
      return redirect(route('login'))->with(['message', 'Une erreur inattendue s\'est produite.']);
    }
  }
}