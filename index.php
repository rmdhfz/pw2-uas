<!DOCTYPE html>
<html>
<head>
	<title>Sederhana</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap.min.css" media="screen, projection">
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#table-penjual").DataTable();
        });
    </script>
</head>
<body>
	<center>
        <br><br><br>
		<h1>Aplikasi Sederhana Toko Online - CRUD</h1> <br>
        <small> Hafiz Ramadhan - 191011402923</small> <br>
		<button type="button" class="btn btn-sm btn-flat btn-primary waves-effect" data-toggle="modal" data-target="#modal-penjual" data-backdrop="static" data-keyboard="false">
			Tambah Data
		</button><hr><br>
	</center>
	<div class="container">
		<table id="table-penjual" class="table table-striped table-responsive" style="width: 100%;">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
					<th>Email</th>
					<th>Nomor Telepon</th>
                    <th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					require_once 'connect.php';
					$query = mysqli_query($con, "SELECT * FROM penjual");
					if($query){
						$no = 1;
						while($object = mysqli_fetch_object($query)){ ?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $object->nama;?></td>
								<td><?php echo $object->email;?></td>
								<td><?php echo $object->no_telp;?></td>
								<td>
									<a id="edit" data-id="<?php echo $object->id;?>" class="btn btn-warning btn-sm">Edit</a>
									<a id="delete" data-id="<?php echo $object->id;?>" class="btn btn-danger btn-sm">Delete</a>
								</td>
							</tr>
						<?php $no++; } ?>
					 <?php } ?>
			</tbody>
		</table>
	</div>

	<div id="modal-penjual" tabindex="-1" role="dialog" class="modal fade modal-flex">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Form Penjual</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<form id="form-penjual" accept-charset="utf-8" autocomplete="off" method="post">
							<input type="hidden" name="id" id="id">
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">
									Name
								</label>
								<div class="col-sm-10">
									<input type="text" name="name" id="name" class="form-control" required="1" placeholder="enter your name" minlength="3" maxlength="35">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">
									Email
								</label>
								<div class="col-sm-5">
									<input type="email" name="email" id="email" class="form-control" required="1" placeholder="enter your email" minlength="4" maxlength="35">
								</div>
                                <div class="col-sm-5">
									<input type="text" name="no_telp" id="no_telp" pattern="[0-9]{10,13}" class="form-control" required="1" placeholder="enter your phone" minlength="10" maxlength="13">
								</div>
							</div>
                            <div class="form-group row">
								<label class="col-sm-2 col-form-label">
									Password
								</label>
								<div class="col-sm-10">
									<input type="password" name="password" id="password" class="form-control" required="1" placeholder="enter your password" minlength="3" maxlength="35">
								</div>
							</div>
							<button type="submit" name="submit_" id="submit_" value="true" hidden="1"></button>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" onclick="$('#submit_').click()" class="btn btn-sm btn-primary waves-effect waves-light btn-block">Submit</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function() {
		const FormPenjual = $("#form-penjual");
		FormPenjual.submit(function(event) {
			event.preventDefault();
			const data = $(this).serialize();
			const con = confirm("Are you sure submit this data ?");
			if (con) {
				if (data) {
					let url, id = $("#id").val();
					if (id) {
						url = "update.php";
					}else{
						url = "save.php";
					}
					$.post(url, data, function(resp) {
						if (resp) {
							alert(resp);
							/*reload*/
							window.location.reload(false);
						}
					});
				}
			}else{
				console.log("Cancel submit");
			}
		});

		/*get byid*/
		$("#table-penjual").on('click', '#edit', function(event) {
			event.preventDefault();
			const id = $(this).data('id');
			if (id) {
				$.post('getById.php', {id: id}, function(resp) {
					if (resp) {
						let response = $.parseJSON(resp),
							data = response.data;
							if (data) {
								$("#modal-penjual").modal('show');
								$("#id").val(data.id);
								$("#name").val(data.nama);
								$("#email").val(data.email);
                                $("#no_telp").val(data.no_telp);
							}
					}
				});
			}
		});

		/*delete*/
		$("#table-penjual").on('click', '#delete', function(event) {
			event.preventDefault();
			const con = confirm("Are you sure to delete this data ?");
			if (con) {
				/*confirm*/
				const id = $(this).data('id');
				if (id) {
					$.post('delete.php', {id: id}, function(resp) {
						if (resp) {
							alert(resp);
							window.location.reload(false); // reload
						}
					});
				}
			}else{
				console.log("cancel delete");
			}
		});
	});
</script>
</html>