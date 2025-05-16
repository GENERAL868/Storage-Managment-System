<?php
session_start();
if (!isset($_SESSION['UID'])) {
    header('Location: error.php?ec=1'); // user not logged in
    exit;
}

$pageTitle = 'Inventory Management System';
include('header.php');
include('dbconnect.php');
?>

<link rel="stylesheet" href="styles.css">

<div id="topLinks">
    <ul>
        <li><a href="formToSearch.php">Home</a></li>
        <?php if ($_SESSION['TYPE'] === 'A'): ?>
            <li><a href="suppliers.php">Add or Delete suppliers</a></li>
            <li><a href="formItems.php">Add or Delete or Update items For Suppliers</a></li>
        <?php endif; ?>
    </ul>
</div>

<div class="container">
  <form action="searchResult.php" method="post" class="search-form" autocomplete="off">
      <h2>Search for Items</h2>

      <div>
          <label for="nm">Description</label>
          <input type="text" id="nm" name="nm" placeholder="Enter description" />
      </div>

      <div>
          <label for="ic">Item Code</label>
          <input type="text" id="ic" name="ic" placeholder="Enter item code" />
      </div>

      <fieldset class="categories">
          <legend>Category</legend>
          <div class="checkbox-group">
            <?php
            $q = "SELECT * FROM categories";
            $r = mysqli_query($conn, $q) or die("Error in query: $q " . mysqli_error($conn));
            while ($cat = mysqli_fetch_assoc($r)): ?>
              <label class="checkbox-label">
                <input type="checkbox" name="ct[]" value="<?= ($cat['categoryCode']) ?>">
                <?= ($cat['categoryDesc']) ?>
              </label>
            <?php endwhile; ?>
          </div>
      </fieldset>

      <div>
          <label for="sl">Storage Location</label>
          <input type="text" id="sl" name="sl" placeholder="Enter storage location" />
      </div>

      <div class="price-range">
          <label>Price Range</label>
          <div class="range-inputs">
              <input type="number" name="pf" class="input-80px" placeholder="Min" />
              <span>to</span>
              <input type="number" name="pt" class="input-80px" placeholder="Max" />
          </div>
      </div>

      <div>
          <label for="ls">Last Supplier</label>
          <select name="ls" id="ls">
              <?php
              $q = "SELECT * FROM suppliers";
              $r = mysqli_query($conn, $q) or die("Error in query: $q " . mysqli_error($conn));
              $count = mysqli_num_rows($r);
              echo "<option value=''>Select from $count suppliers</option>";
              $i = 0;
              while ($sup = mysqli_fetch_assoc($r)):
                  $p_query = "SELECT COUNT(*) as product_count FROM items WHERE iLastSupplierId = " . (int)$sup['supplierId'];
                  $p_result = mysqli_query($conn, $p_query);
                  $p = mysqli_fetch_assoc($p_result)['product_count'];
                  $i++;
              ?>
                  <option value="<?= (int)$sup['supplierId'] ?>">
                      (<?= $i ?>) <?= ($sup['supplierName']) ?> [ <?= $p ?> products ]
                  </option>
              <?php endwhile; ?>
          </select>
      </div>

      <div class="quantity-range">
          <label>Quantity on Hand</label>
          <div class="range-inputs">
              <input type="number" name="qf" class="input-80px" placeholder="Min" />
              <span>to</span>
              <input type="number" name="qt" class="input-80px" placeholder="Max" />
          </div>
      </div>

      <div class="buttons">
          <input type="submit" value="Show Result" />
          <input type="reset" value="Clear Data" />
      </div>
  </form>
</div>

<?php include('footer.php'); ?>
