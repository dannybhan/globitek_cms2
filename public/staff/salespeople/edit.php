<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$salespeople_result = find_salesperson_by_id($_GET['id']);
// No loop, only one result
$salesperson = db_fetch_assoc($salespeople_result);

// Default values for all page variables
$errors = [];

if (is_post_request()) {
    // Confirm values
    $salesperson['first_name'] = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $salesperson['last_name'] = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    
    $result = update_salesperson($salesperson);
    if ($result === true) {
        redirect_to('show.php?id=' . $salesperson['id']);
    }
    else {
        $errors = $result;
    }

}
?>

<?php $page_title = 'Staff: Edit Salesperson ' . $salesperson['first_name'] . " " . $salesperson['last_name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Salespeople List</a><br />

  <h1>Edit Salesperson: <?php echo $salesperson['first_name'] . " " . $salesperson['last_name']; ?></h1>
    
    <?php echo display_errors[$errors]; ?>

  <!-- TODO add form -->
    <form action="edit.php?id=<?php echo $user['id']; ?>" method="post">
    First Name:<br>
        <input type="text" name="first_name" value="<?php echo $salesperson['first_name']; ?>"/><br>
    Last Name: <br>
        <input type="text" name="last_Name" value="<?php echo $salesperson['last_name']; ?>"/><br>
        <br>
        <input type="submit" name="submit" value="Update">
    </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
