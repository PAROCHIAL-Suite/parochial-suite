<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/ui.css">
  <link rel="stylesheet" type="text/css" href="../print.css">
  <script src="../print.js"></script>
  <style type="text/css">
    .btnPrint {
      background: white;
      height: 43px !important;
      margin: auto;
      text-align: center;
    }

    #data td:nth-child(1) {
      background: ;
      padding-left: 30px;
    }
  </style>

  <title>Certificate - <?php echo $_GET['id']; ?></title>
</head>

<body>
  <?php include '../nav/global_nav.php'; ?>
  <br><br>
  <div class="pageName card-heading">
    <table border="0">
      <tr>
        <td width="40%">
          <h3>REPORT PRINTING</h3>
        </td>
      </tr>
    </table>
  </div>

  <?php include '../printNav.php'; ?>
  <br>

  <div class="reportContainer">
    <div id="printJS-form">
      <?php include '../prefrences/letterHead_header.php'; ?>
      <hr style="border: 1px double;">
      <br><br>
      <div style="text-align: center; font-size: 29px; font-style: italic; font-weight: bold;">Notification of
        Confirmation</div>
      <br><br>
      <?php
      include '../config/connection.php';
      $id = $_GET['id'];
      $sql = "SELECT * FROM confirmation WHERE id = '$id'";
      $result = $conn->query($sql);
      while ($rows = $result->fetch_assoc()) {
        ?>
        <p style="float: right;"><b>Date:</b> <?php echo date("d/m/Y"); ?></p>
        <p>To, <br />The Parish Priest<br /><?php echo $rows['baptism_parish']; ?></p>
        <p><b>Subject:</b> Notification of the Sacrament of Confirmation</p>
        <p>Dear Fr.</p>
        <p>This letter informs you that <b><?php echo $rows['name'] . " " . $rows['surname']; ?></b> who was baptized at
          your church, recently received the Sacrament of Confirmation. The date of his/her baptism was
          <b><?php echo $rows['baptism_date']; ?></b> and the registration no. is
          <b><?php echo $rows['baptism_reg_no']; ?></b></p>
        <p>Please incorporate the following information into the baptismal entry for this person: This person received
          Confirmation on <b><?php echo $rows['date_of_confirmation']; ?></b> at
          <b><?php echo $rows['church_of_confirmation']; ?></b>.</p>
        <p>Thank you for your kind assistance in this matter.
          <br /><br />Sincerely,<br /><br /><br />
          <?php echo $rows['parish_priest']; ?>
        </p>
        <br><br><br><br>
        <p><br /><b><i>NOTE:</i></b> Please complete the bottom portion of this letter and return it to us in the enclosed
          envelope.</p>
        <hr>
        <p>The entry regarding Confirmation has been made in the Baptismal Registry regarding
          <b><?php echo $rows['name'] . " " . $rows['surname']; ?></b>.</p><br /><br />
        <p><br />The Parish Priest<br /><?php echo $rows['baptism_parish']; ?>
          <br />
          (parish seal)
        </p>
        <p>&nbsp;</p>

      <?php } ?>
    </div>


  </div>
  <br><br><br><br>
</body>

</html>