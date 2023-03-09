<?php
include('../Connection/db_connection.php');
session_start();
if(isset($_GET['product_id']))
{
    $edit_id=$_GET['product_id'];
    $select_product_query="select * from product_tbl where product_id=$edit_id";
    $result_product=mysqli_query($con,$select_product_query);
    $row_product=mysqli_fetch_assoc($result_product);
        $product_name=$row_product['product_name'];
        $product_description=$row_product['product_description'];
        $product_keyword=$row_product['product_keyword'];
        $category_id=$row_product['category_id'];
        $sub_category_id=$row_product['sub_category_id'];
        $product_image=$row_product['product_image'];
        $product_stock=$row_product['product_stock'];
        $product_offer=$row_product['product_offer'];
        $product_actual_price=$row_product['product_actual_price'];
        $product_current_price=$row_product['product_current_price'];
        

        /* Category Listing */

        $select_category="select * from category_tbl where category_id=$category_id";
        $result_cat=mysqli_query($con,$select_category);
        $row_fetch=mysqli_fetch_assoc($result_cat);
        $category=$row_fetch['category_name'];

        /* Sub Category Listing  */
        $select_sub_category="select * from sub_category_tbl where sub_category_id=$sub_category_id";
        $result_sub_cat=mysqli_query($con,$select_sub_category);
        $row_fetch_sub=mysqli_fetch_assoc($result_sub_cat);
        $sub_category=$row_fetch_sub['sub_category_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- logo -->
		<link rel="icon" href="../images/ace_logo.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Sub Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
   $(document).ready(function(){
    $("#category").change(function(){
        var category_id=$(this).val();
        $.ajax({
            url:"getsubcategory.php",
            method:"POST",
            data:{category_ID:category_id},
            success:function(data){
                $("#subcategory").html(data);
            }
        }); 
    });
});
    </script>

<script type="text/javascript">
        function calculate() {
   var product_actual_price=0, product_offer=0, product_current_price=0;
    product_actual_price = Number(document.discountCalculator.product_actual_price.value);
    product_offer = Number(document.discountCalculator.product_offer.value);


    product_current_price=product_actual_price - ( product_actual_price*product_offer/100 );

   document.discountCalculator.product_actual_price.value=product_actual_price.toFixed(2);
   document.discountCalculator.product_offer.value=product_offer.toFixed(2);
   document.discountCalculator.product_current_price.value=product_current_price.toFixed(2);

}

    </script>
</head>
<style>
  .logo{
    width: 6%;
    height: 6%;
}
.upload{
    width: 100px;
    objeect-fit: contain;
}
.agile-login ul a {
    font-size: bold;
    text-transform: capitalize;
    color: black;
    text-decoration: none;
}
body
{
    overflow-x:hidden;
}
</style>
<body class="bg-light">
<div class="container-fluid p-0">
  <!--First Child Start-->
            <nav class="navbar nav-expand-lg bg-primary">
                      
                          <img src="../images/ace_logo.png" alt=""class="logo">
                                <div class="agile-login">
                                  <div class="text-center  p-2">
                                    <ul>
                                    <?php
          
					if(!isset($_SESSION['admin_name']))
					{
						echo "<b><a href='#' class='text-white'></a></b>";
					}else
					{
            $admin_name=$_SESSION['admin_name'];
						echo "<b><a href='#' class='text-white'>Welcome $admin_name</a></b>";
					}
					?>
          <br>
         
          <?php
					if(!isset($_SESSION['admin_name']))
					{
						echo "<b><a href='./admin_login.php' class='text-white btn btn-dark'>Login</a></b>";
					}else
					{
						echo "<b><a href='../index.php' class='text-white btn btn-dark'>Logout</a></b>";
					}
					?>
                                    </ul>
                                  </div>
                                </div>
                      
            </nav>
        <!--First Child End-->
<!--Second Child Start-->
                            <div class="bg-light">
                                        <h3 class="text-center p-2">
                                          Manage Detials
                                        </h3>
                            </div>
<!-- Second Child End  -->
<!-- Navbar Start -->
              <nav class="navbar navbar-expand-lg bg-primary">
  
    <a class="navbar-brand text-white" href="#">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="index.php">Home Page</a>
</li>
</ul>
</div>

</nav>

    <br>

       <h2 class="text-center text-dark mb-3">Edit Product</h2>
       <hr>
</nav>
<div class="container-fluid p-0">
    

<form name="discountCalculator" action="" method="post" enctype="multipart/form-data">
      
<!--Title-->
<div class="form-outline mb-4 w-50 m-auto">
                <label for="product_name" class="form-label">
                    Product Name
                </label>
                        <input type="text" name="product_name" value="<?php echo $product_name ;?>"
                        id="product_name" class="form-control" placeholder="Enter the Product Name"
                        autocomplete="off">
            </div>
            
        <!--Discription-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_discription" class="form-label">Product
                Discription
                </label>
                        <input type="text" name="product_discription" value="<?php echo $product_description ;?>"
                        id="product_discription" class="form-control" placeholder="Enter the Product Discription"
                        autocomplete="off">
            </div>

        <!--Search Keyword-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">
                Product Search Keyword
                </label>
                        <input type="text" name="product_keyword" value="<?php echo $product_keyword ;?>"
                        id="product_keyword" class="form-control" placeholder="Enter the Product Keyword"
                        autocomplete="off">
            </div>

        <!-- Category -->
        
        <div class="form-outline mb-4 w-50 m-auto">
                            <label for="product_category" class="form-label">
                                Product Categorys
                            </label>
                                <select id="category" name="product_category"
                                class="form-select">
                                    <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                                    <?php
            $select_category_query="select * from category_tbl order by category_name";
            $result_category=mysqli_query($con,$select_category_query);
            while($row_category=mysqli_fetch_assoc($result_category))
            {
                $category_id=$row_category['category_id'];
                $category_name=$row_category['category_name'];
                echo "<option value='$category_id'>$category_name</option>";
            }  
           ?>
          </select> 
        </div>
          <!-- Sub Category -->
          <div class="form-outline mb-4 w-50 m-auto">
                            <label for="product_sub_category" class="form-label">
                                Product Sub Categorys
                            </label>
                                <select id="subcategory" name="product_sub_category"
                                class="form-select">
                                    <option value="<?php echo $sub_category ?>"><?php echo $sub_category ?></option>
        </select>
    </div>

        <!--Product Image -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image" class="form-label">
                    Product Image 
                </label>
                <div class="d-flex">
                        <input type="file" name="product_image"
                        id="product_image" class="form-control" value="./Product_Image/<?php echo $product_image ?>">
                        <img src="./Product_Image/<?php echo $product_image ?>" 
                        alt="" srcset="" class="upload">
</div>
            </div> 
        
            <!-- Product Stock -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_stock" class="form-label">Product Stock
                </label>
                        <input type="number" name="stock" min="1" max="15" value="<?php echo $product_stock ;?>"
                        id="stock" class="form-control" placeholder="Enter the Product Stock"
                        autocomplete="off" required="required">
            </div>

        <!-- Product Offer -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_offer" class="form-label">Product Discount
                </label>
                        <input type="number" name="product_offer" value="<?php echo $product_offer ;?>"
                        id="discount" class="form-control" placeholder="Enter the Discount"
                        autocomplete="off">
            </div>

        <!-- Product Actual Price  -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_actual_price" class="form-label">Product Actual
                Price
                </label>
                        <input type="text" value="<?php echo $product_actual_price ;?>"
                        name="product_actual_price" placeholder="Enter the Product Actual Price"
                        id="price" class="form-control"
                        autocomplete="off">
            </div>
       
            <!-- <div class="form-outline mb-4 w-50 m-auto">
                <button get_price>Discount Calculation</button>
            </div> -->

        <!--Product Current Price-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_current_price" class="form-label">Product Current
                Price
                </label>
                        <input type="text" name="product_current_price" id="total"
                         class="form-control" value="<?php echo $product_current_price ;?>"
                        autocomplete="off">
            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="update_product" class="form-control btn btn-primary text-white mb-3 px-3" value="Update Product">
            </div>
</form>
<div class="form-outline mb-4 w-50 m-auto">
        <input type="button" class="btn btn-success text-white mb-3 px-3" value="Calculate Discount" onclick="calculate()">
        </div>




</div>
<div class="bg-primary p-3 text-center">
<p>All right Reserved @-Designed By Joyal Shaji</p>
</div>
</div>
 <!--Bootstrap JS Link-->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
 
</body>
</html>


<?php

        if(isset($_POST['update_product'])){

        $product_name=$_POST['product_name'];
        $product_discription=$_POST['product_discription'];
        $product_keyword=$_POST['product_keyword'];
        $product_category=$_POST['product_category'];
        $product_sub_category=$_POST['product_sub_category'];
        $product_stock=$_POST['stock'];
        $product_offer=$_POST['product_offer'];
        $product_actual_price=$_POST['product_actual_price'];
        $product_current_price=$_POST['product_current_price'];
        
        //Image Accessing 

        $product_image=$_FILES['product_image']['name'];
        

        //Image Accessing for tmp Image
        
        $temp_image=$_FILES['product_image']['tmp_name'];

        //Check Empty Conditions

        if($product_name=='' or $product_discription=='' or $product_keyword=='' or $product_category=='' 
        or $product_sub_category=='' or $product_actual_price=='' or $product_stock=='' or
        $product_current_price=='' or $product_image=='' or $product_offer=='')
        {
              echo "<script>alert('Please Fill the Blank Spaces')</script>";
        }else
        {
            move_uploaded_file($temp_image,"./Product_Image/$product_image");
            
            //update query

            $update_product_query="update product_tbl set product_name='$product_name',product_description='$product_discription'
            ,product_keyword='$product_keyword',category_id='$product_category',sub_category_id='$product_sub_category',
            product_image='$product_image',product_stock='$product_stock',product_offer='$product_offer',product_actual_price='$product_actual_price',
            product_current_price='$product_current_price',date=NOW() where product_id=$edit_id";
            $result_update=mysqli_query($con,$update_product_query);
            if($result_update)
            {
                echo "<script>alert('Product Updated Successfully')</script>";
                echo "<script>window.open('./view_product.php','_self')</script>";

            }
        }
        
    }

?>