<!-- This purpose of this file is to avoid unauthorized access to all the website files -->
<?PHP
if(empty($_SESSION['adminName'])){
    die("<script>alert('Please log in.');
    window.location.href='index.php'</script>");
}
?>