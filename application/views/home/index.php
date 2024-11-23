<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <!-- DataTables -->
  <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" rel="stylesheet">

  <title><?php echo $title; ?></title>
</head>

<body>
  <header>
    <nav class="navbar navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand font-weight-bold" href="#">
          Report App
        </a>
      </div>
    </nav>
  </header>
  <main>
    <div class="container min-vh-100">
      <div class="row">
        <div class="col-md-12 mt-4 text-right">
          <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addModal">
            Add Data
          </button>
        </div>
        <div class="col-md-12 mt-2">
          <!-- Add Modal -->
          <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addModalLabel">Add Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- Add Form -->
                  <form action="" method="post" id="form">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Position</label>
                      <input type="text" id="position" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Office</label>
                      <input type="text" id="office" class="form-control">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="add">Add Data</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 mt-4">
            <div class="table-responsive">
              <table class="table" id="records">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Edit Form -->
            <form action="" method="post" id="edit_form">
              <input type="hidden" id="edit_id" name="edit_id" value="">
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" id="edit_name" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Position</label>
                <input type="text" id="edit_position" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Office</label>
                <input type="text" id="edit_office" class="form-control">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="update">Save</button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer class="text-center bg-light p-4"><strong>By Ahmad Noveliansyah</strong></footer>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/js/all.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.js"></script>
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <script>
  const alert = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger mr-2'
    },
    buttonsStyling: false
  })

  function fetch() {
    $.ajax({
      url: "<?php echo base_url(); ?>fetch",
      type: "post",
      dataType: "json",
      success: function(data) {
        if (data.status == "success") {

          $('#records').DataTable({
            info: false,
            ordering: false,
            paging: false,
            "data": data.data,
            "responsive": true,
            "columns": [{
                "data": "id"
              },
              {
                "data": "name"
              },
              {
                "data": "position"
              },
              {
                "data": "office"
              },
              {
                "render": function(data, type, row, meta) {
                  const a = `
                            <a href="#" value="${row.id}" id="edit" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
                            <a href="#" value="${row.id}" id="del" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
                          `;
                  return a;
                }
              }
            ]
          });
        } else {
          alert.fire("Failed to Load Data");
        }

      }
    });

  }

  fetch();

  // Add Data 
  $(document).on("click", "#add", function(e) {
    e.preventDefault();

    const name = $("#name").val();
    const position = $("#position").val();
    const office = $("#office").val();

    if (name === "" || position === "" || office === "") {
      alert("All field is required");
    } else {

      $.ajax({
        url: "<?php echo base_url(); ?>add",
        type: "post",
        dataType: "json",
        data: {
          name,
          position,
          office
        },
        success: function(data) {
          if (data.status == "success") {
            $('#records').DataTable().destroy();
            fetch();
            $('#addModal').modal('hide');

            alert.fire("Success", "Data has been successfully added!", "success");
          } else {
            alert.fire(data.message ?? "Failed to add data!");
          }
        }
      });

      $("#form")[0].reset();
    }
  });

  // Delete Data

  $(document).on("click", "#del", function(e) {
    e.preventDefault();

    const del_id = $(this).attr("value");

    const deleteAlert = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-danger',
        cancelButton: 'btn btn-success mr-2'
      },
      buttonsStyling: false
    })

    deleteAlert.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',

      reverseButtons: true
    }).then((result) => {
      if (result.value) {

        $.ajax({
          url: "<?php echo base_url(); ?>delete",
          type: "post",
          dataType: "json",
          data: {
            id: del_id
          },
          success: function(data) {
            if (data.status == "success") {
              $('#records').DataTable().destroy();
              fetch();
              alert.fire(
                'Deleted!',
                'Data has been successfully deleted!',
                'success'
              );
            } else {
              alert.fire(
                'Cancelled',
                'Failed to delete data!',
                'error'
              );
            }

          }
        });
      } else if (
        result.dismiss === Swal.DismissReason.cancel
      ) {
        alert.fire(
          'Cancelled',
          'Data deletion has been canceled!',
          'error'
        )
      }
    });
  });

  // Edit Data

  $(document).on("click", "#edit", function(e) {
    e.preventDefault();

    const edit_id = $(this).attr("value");

    $.ajax({
      url: "<?php echo base_url(); ?>fetch_by_id",
      type: "post",
      dataType: "json",
      data: {
        id: edit_id
      },
      success: function(data) {
        if (data.status == "success") {
          $('#editModal').modal('show');
          $("#edit_id").val(data.data.id);
          $("#edit_name").val(data.data.name);
          $("#edit_position").val(data.data.position);
          $("#edit_office").val(data.data.office);
        } else {
          alert.fire(data.message);
        }
      }
    });
  });

  // Update Data

  $(document).on("click", "#update", function(e) {
    e.preventDefault();

    const edit_id = $("#edit_id").val();
    const edit_name = $("#edit_name").val();
    const edit_position = $("#edit_position").val();
    const edit_office = $("#edit_office").val();

    if (edit_id == "" || edit_name == "" || edit_position == "" || edit_office == "") {
      alert("All field is required");
    } else {
      $.ajax({
        url: "<?php echo base_url(); ?>edit",
        type: "post",
        dataType: "json",
        data: {
          id: edit_id,
          name: edit_name,
          position: edit_position,
          office: edit_office,
        },
        success: function(data) {
          if (data.status == "success") {
            $('#records').DataTable().destroy();
            fetch();
            $('#editModal').modal('hide');

            alert.fire("Success", "Data has been successfully updated!", "success");
          } else {
            alert.fire(data.message ?? "Failed to update data!");
          }
        }
      });
    }
  });
  </script>

</body>

</html>