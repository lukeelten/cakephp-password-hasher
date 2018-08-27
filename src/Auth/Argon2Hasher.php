<?php

namespace lukeelten\PasswordHasher\Auth;

use Cake\Auth\AbstractPasswordHasher;
use ParagonIE_Sodium_Compat;

class Argon2Hasher extends AbstractPasswordHasher {

    /**
     * Generates password hash.
     *
     * @param string|array $password Plain text password to hash or array of data
     *   required to generate password hash.
     * @return string Password hash
     */
    public function hash($password) {
        if (defined("PASSWORD_ARGON2I")) {
            return password_hash($password, PASSWORD_ARGON2I);
        }

        if (extension_loaded("sodium")) {
            return sodium_crypto_pwhash_str(
                $password,
                SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE,
                SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE
            );
        }

        if (class_exists("ParagonIE_Sodium_Compat")) {
            return ParagonIE_Sodium_Compat::crypto_pwhash_str(
                $password,
                ParagonIE_Sodium_Compat::CRYPTO_PWHASH_OPSLIMIT_MODERATE,
                ParagonIE_Sodium_Compat::CRYPTO_PWHASH_MEMLIMIT_MODERATE
            );
        }

        throw new HasherException("No usuable password hasher found.");
    }

    /**
     * Check hash. Generate hash from user provided password string or data array
     * and check against existing hash.
     *
     * @param string|array $password Plain text password to hash or data array.
     * @param string $hashedPassword Existing hashed password.
     * @return bool True if hashes match else false.
     */
    public function check($password, $hashedPassword) {
        if (defined("PASSWORD_ARGON2I")) {
            return password_verify($password, $hashedPassword);
        }

        if (extension_loaded("sodium")) {
            return sodium_crypto_pwhash_str_verify($hashedPassword, $password);
        }

        if (class_exists("ParagonIE_Sodium_Compat")) {
            return ParagonIE_Sodium_Compat::crypto_pwhash_str_verify($hashedPassword, $password);
        }

        throw new HasherException("No usuable password hasher found.");
    }


    public function needsRehash($password) {
        if (defined("PASSWORD_ARGON2I")) {
            return password_needs_rehash($password, PASSWORD_ARGON2I);
        }

        if (extension_loaded("sodium")) {
            return sodium_crypto_pwhash_str_needs_rehash(
                $password,
                SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE,
                SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE
            );
        }

        if (class_exists("ParagonIE_Sodium_Compat")) {
            return false; // compat lib is installed. ignore request
        }

        throw new HasherException("No usuable password hasher found.");
    }

}