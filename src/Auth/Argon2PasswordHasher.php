<?php

namespace lukeelten\PasswordHasher\Auth;

use Cake\Auth\AbstractPasswordHasher;
use ParagonIE_Sodium_Compat;

/**
 * Class Argon2PasswordHasher
 *
 * This class provides thhe functionality to hash passwords with Argon2i even with an older PHP version.
 * PHP supports Argon2i since version 7.2, but there are still some downsides.
 *
 * @package lukeelten\PasswordHasher\Auth
 * @since 1.0.0
 * @author Tobias Derksen <tobias@nulap.com>
 * @license https://opensource.org/licenses/mit-license.php MIT License
 */
class Argon2PasswordHasher extends AbstractPasswordHasher
{

    /**
     * Generates password hash.
     *
     * @param string|array $password Plain text password to hash or array of data
     *   required to generate password hash.
     * @return string Password hash
     * @throws PasswordHasherException When something goes wrong or no crypto extension can be found
     */
    public function hash($password)
    {
        // If PHP supports Argon2i for password_hash, use this.
        if (defined("PASSWORD_ARGON2I")) {
            return password_hash($password, PASSWORD_ARGON2I);
        }

        // If sodium extension is loaded (PHP 7.2), use the extension.
        // This is usually faster than the proxy via compat
        if (extension_loaded("sodium")) {
            try {
                return sodium_crypto_pwhash_str(
                    $password,
                    SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE,
                    SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE
                );
            } catch (\Exception $ex) {
                throw new PasswordHasherException("Error while hashing password", $ex->getCode(), $ex);
            }
        }

        // If sodium polyfill library is installed, use the library
        // The library will determine the fastest way to hash the passwword
        if (class_exists("ParagonIE_Sodium_Compat")) {
            try {
                return ParagonIE_Sodium_Compat::crypto_pwhash_str(
                    $password,
                    ParagonIE_Sodium_Compat::CRYPTO_PWHASH_OPSLIMIT_MODERATE,
                    ParagonIE_Sodium_Compat::CRYPTO_PWHASH_MEMLIMIT_MODERATE
                );
            } catch (\SodiumException $ex) {
                throw new PasswordHasherException("Error while hashing password", $ex->getCode(), $ex);
            }
        }

        // Throw if no suitable extension is installed.
        throw new PasswordHasherException("No usuable password hasher found.");
    }

    /**
     * Check hash. Generate hash from user provided password string or data array
     * and check against existing hash.
     *
     * @param string|array $password Plain text password to hash or data array.
     * @param string $hashedPassword Existing hashed password.
     * @return bool True if hashes match else false.
     * @throws PasswordHasherException When something goes wrong or no crypto extension can be found
     */
    public function check($password, $hashedPassword)
    {
        if (defined("PASSWORD_ARGON2I")) {
            return password_verify($password, $hashedPassword);
        }

        if (extension_loaded("sodium")) {
            try {
                return sodium_crypto_pwhash_str_verify($hashedPassword, $password);
            } catch (\Exception $ex) {
                throw new PasswordHasherException("Error while verifying password", $ex->getCode(), $ex);
            }
        }

        if (class_exists("ParagonIE_Sodium_Compat")) {
            try {
                return ParagonIE_Sodium_Compat::crypto_pwhash_str_verify($hashedPassword, $password);
            } catch (\SodiumException $ex) {
                throw new PasswordHasherException("Error while verifying password", $ex->getCode(), $ex);
            }
        }

        throw new PasswordHasherException("No usuable password hasher found.");
    }

    /**
     * Check if password needs rehash.
     * If the default hash algorithm has changed, this method indicates whether the password needs a rehash.
     *
     * @param string $password Password to check
     * @return bool True if password needs rehash, otherwise false
     * @throws PasswordHasherException When something goes wrong or no crypto extension can be found
     */
    public function needsRehash($password)
    {
        if (defined("PASSWORD_ARGON2I")) {
            return password_needs_rehash($password, PASSWORD_ARGON2I);
        }

        if (extension_loaded("sodium")) {
            try {
                return sodium_crypto_pwhash_str_needs_rehash(
                    $password,
                    SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE,
                    SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE
                );
            } catch (\Exception $ex) {
                throw new PasswordHasherException("Error while checking password for rehash", $ex->getCode(), $ex);
            }
        }

        if (class_exists("ParagonIE_Sodium_Compat")) {
            return false; // compat lib is installed. ignore request
        }

        throw new PasswordHasherException("No usuable password hasher found.");
    }
}
