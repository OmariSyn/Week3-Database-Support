<?php


include 'db.php';


if(isset($_SESSION['add_to_cart'])){
    $product_id = $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];


    if($quantity > 0) {
        if(isset($_SESSION['cart'][$product_id])){
    
            $_SESSION['cart'][$product_id] += $quantity;
    
    
        } else{
            $_SESSION['cart'][$product_id]  = $quantity;
    
        }
    }
 header("Location: index.php");    


}





$query = 'SELECT * FROM products';
$results = mysqli_query($conn, $query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Shopping Center</title>
</head>
<body>


<style>
table{

    border-spacing: 5px;




}

table, th, td{
 border: 1px solid black;
}


th, td{
    padding: 15px;
    text-align: center;

}




</style>

    

<h2>Cart Products:</h2>


<table border="1" cellpadding = '8' cellspacing='0'>



<tr style="font-size:large">

<th>Product ID</th>
<th>Product Name</th>
<th>Product Description</th>
<th>Product Cost</th>
<th>Qunantity in Stock</th>
<th>Add to Cart</th>
</tr>

<?php while($row = mysqli_fetch_array($results)):?>
<tr>
<td><?php echo $row["Product ID"]?></td>
<td><?php echo $row["Product Name"]?></td>
<td><?php echo $row["Product Description"]?></td>
<td><?php echo $row["Product Cost"]?></td>
<td><?php echo $row["Quantity currently in the cart"]?></td>
<td>
    <form action="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="<?php echo $row["Product ID"];?>">
        <input type="number" name="quanity" value="1" min = '1' style="width: 50px">
        <button type="submit" name="add_to_cart">Add to Cart</button>

    </form>
</td>
</tr>
<?php endwhile;?>

</table>


<h2>
    Unique Items in Session Cart:
    <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
</h2>



<a href="cart.php">View Shopping Cart</a>
</body>
</html>