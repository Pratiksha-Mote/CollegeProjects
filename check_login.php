<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : '';
?>
<script>
var isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
var username = '<?php echo $username; ?>';

if (isLoggedIn) {
    document.addEventListener('DOMContentLoaded', function() {
        // Update login link to show username
        const loginLink = document.querySelector('nav a[href*="log"]');
        if (loginLink) {
            loginLink.textContent = 'Welcome ' + username;
            loginLink.href = 'logout.php';
        }
    });
}
</script>