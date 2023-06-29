<?php
session_start();

// Check if the user is logged in as a customer
if (!isset($_SESSION['username']) || $_SESSION['username'] === 'admin') {
  header('Location: index.html');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Customer Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }
    
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-top: 50px;
    }
    
    .container h2 {
      text-align: center;
    }

    .cont {
      display: flex;
      flex-direction: row;
      margin: 7px 0px 7px 0px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      
      display: inline-block;
      width: 120px;
      font-weight: bold;
      margin-bottom: 5px;
    }
    
    .form-group input {
      display: inline-block;
      width: calc(100% - 120px);
      padding: 5px;
      border: 2px solid #ccc;
      border-radius: 3px;
    }
    
    .form-group button {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      border: none;
      color: #ffffff;
      cursor: pointer;
      border-radius: 3px;
    }
    .form-group a button {
      background-color: red;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <form id="dataForm" method="POST" action="save_data.php">
      <div class="form-group">
        <div class="cont">
          <label for="date">Order Date:</label>
          <input type="date" id="date" name="date" required>
        </div>
        <div class="cont">
          <label for="company">Company:</label>
          <input type="text" id="company" name="company" required>
        </div>
        <div class="cont">
          <label for="owner">Owner:</label>
          <input type="text" id="owner" name="owner" required>
        </div>
        <div class="cont">
          <label for="item">Item:</label>
          <input type="text" id="item" name="item" required>
        </div>
        <div class="cont">
          <label for="quantity">Quantity:</label>
          <input type="number" id="quantity" name="quantity" required>
        </div>
        <div class="cont">
          <label for="weight">Weight:</label>
          <input type="number" id="weight" name="weight" required>
        </div>
        <div class="cont">
          <label for="request">Request for Shipment:</label>
          <input type="text" id="request" name="request" required>
        </div>
        <div class="cont">
          <label for="id">Tracking ID:</label>
          <input type="text" id="id" name="id" required>
        </div>
        <div class="cont">
          <label for="size">Shipment Size:</label>
          <input type="text" id="size" name="size" required>
        </div>
        <div class="cont">
          <label for="count">Box Count:</label>
          <input type="number" id="count" name="count" required>
        </div>
        <div class="cont">
          <label for="specification">Specification:</label>
          <input type="text" id="specification" name="specification" required>
        </div>
        <div class="cont">
          <label for="checklist">CheckList Quantity:</label>
          <input type="text" id="checklist" name="checklist" required>
        </div>
      </div>
      <div class="form-group">
        <button type="submit">Save</button>
      </div>
      <div class="form-group">
        <a href="logout.php">
          <button>Logout</button>
        </a>
      </div>
    </form>
    <!-- <p><a href="logout.php">Logout</a></p> -->
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#dataForm').submit(function(event) {
        event.preventDefault();
        
        // Fetch form values
        var date = $('#date').val();
        var company = $('#company').val();
        var owner = $('#owner').val();
        var item = $('#item').val();
        var quantity = $('#quantity').val();
        var weight = $('#weight').val();
        var request = $('#request').val();
        var id = $('#id').val();
        var size = $('#size').val();
        var count = $('#count').val();
        var specification = $('#specification').val();
        var checklist = $('#checklist').val();
        
        // Send AJAX request to save_data.php
        $.ajax({
          type: 'POST',
          url: 'save_data.php',
          data: {
            date: date,
            company: company,
            owner: owner,
            item: item,
            quantity: quantity,
            weight: weight,
            request: request,
            id: id,
            size: size,
            count: count,
            specification: specification,
            checklist: checklist
          },
          success: function(response) {
            alert('Data saved successfully!');
          }
        });
      });
    });
  </script>
</body>
</html>
