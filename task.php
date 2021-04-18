<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->
  <a href='index.php?deconnexion=true'><span>Déconnexion</span></a>
</br>
</br>
             <?php
                  if(isset($_GET['deconnexion']))
                 {
                    if($_GET['deconnexion']==true)
                    {
						session_unset();
						// destroy the session
						session_destroy();                       
                       header("location:index.php");
                    }
                 }
                   if(empty( $_SESSION['username']) ){
					session_unset();

// destroy the session
session_destroy();                       
                     
                       header("location:index.php");                                  }
               elseif ($_SESSION['username'] !== ""){
                     $user = $_SESSION['username'];
                     // afficher un message
                     echo "Bonjour $user, vous êtes connectés";
                 }
           ?>
      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php } ?>

      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="save_task.php" method="POST">
          <div class="form-group">
            <input type="text" name="title" required="required" pattern="[0-9]{1,20}" class="form-control" placeholder="Numéro Tel" autofocus>
          </div>
          <div class="form-group">
            <textarea name="description" rows="2" class="form-control" required="required" pattern="[A-Za-z0-9]{1,20}" placeholder="Personne"></textarea>
          </div>
          <input type="submit" name="save_task" class="btn btn-success btn-block" value="Ajouter">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Numéro Tel</th>
            <th>Personne</th>
            <th>Ajouté le </th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM task";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
