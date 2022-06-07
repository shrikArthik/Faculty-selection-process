<?php
  include_once ("inc/classes/session.php");
  include ("inc/classes/View.php");

  $userSession = new Session();
  if ($userSession->getSession('login') != true) {
    header('Location: login.php');
  }
  $userSession->destroy();

  $view = new View();
  $viewQuestions = $view->viewQuestions();
  //var_dump($viewCandidates);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View all Questions</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  </head>
  <body>

<!------ Include the above in your HEAD tag ---------->

<div class="container">
<?php include ('nav.php'); ?>
    <div id="signupbox" style=" margin-top:10px" class="mainbox col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">View All Questions</div>

            </div>
            <div class="panel-body" >
              <table class="table table-bordered" style="width: 100%; table-layout: auto;">
                <thead>
                  <tr>
                    <th style="width: 10%;">SL</th>
                    <th style="width: 80%;">Question</th>
                    <th style="width: 10%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($viewQuestions as $viewQuestion): ?>
                  <tr>
                    <td style="vertical-align: middle;"><?php $i += 1; echo $i; ?></td>
                    <td style="vertical-align: middle;"><?php echo $viewQuestion['question']; ?></td>
                    <td style="vertical-align: middle;">
                      <a href="editQuestion.php?id=<?php echo $viewQuestion['question_id']; ?>" style="width: 100px;" class="btn btn-primary">Edit</a>
                      <a href="delete.php?action=questiondelete&id=<?php echo $viewQuestion['question_id']; ?>" style="width: 100px; margin-top: 10px;" class="btn btn-danger">Delete</a>
                  </tr>
                  <?php endforeach; ?>

                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
</div>
  </body>
</html>

