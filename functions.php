<?php
// Hash the password before storing it
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Verify the password during login
function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}
?>
