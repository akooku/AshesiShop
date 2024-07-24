<h3 class="text-center">All Categories</h3>
<table class="custom-table table-bordered text-center mt-3">
    <thead class="custom-bg">
        <th>#</th>
        <th>Name</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody>
        <?php
        
        $select_cat = "SELECT * FROM categories";
        $result_cat = mysqli_query($conn, $select_cat);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result_cat)) {
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];
            $number++;
            echo "<tr>
                    <td>$number</td>
                    <td>$category_name</td>
                    <td><a href='index.php?edit_category=$category_id'><i class='fa-solid fa-pen-to-square'></i></a></td>
                    <td><a href='index.php?delete_category=$category_id' type='button' data-bs-toggle='modal' data-bs-target='#deleteModal'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";
        }
        
        ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure you want to delete this?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-custom-bg-2" data-bs-dismiss="modal">No</button>
        <button type="button"><a href="index.php?delete_category=<?php echo $category_id; ?>" class="btn btn-custom-bg">Yes</a></button>
      </div>
    </div>
  </div>
</div>