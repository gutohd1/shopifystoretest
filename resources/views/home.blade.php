<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>My shopify test</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-mb-4">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#customModal">
                add Custom Line Item
              </button>
              <button type="button" class="btn btn-primary" id="getLineItemByVariantId">
                get Line Item by variant id
              </button>
              <button type="button" class="btn btn-primary" id="addLineItemByVariantId">
                add Line Item by variant id
              </button>
              <button type="button" class="btn btn-primary" id="replaceLineItemByVariantId">
                replace Line Item by variant id
              </button>
              <button type="button" class="btn btn-primary" id="removeLineItemByVariantId">
                remove Line Item by variant id
              </button>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Modal -->
  <div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add custom line item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="title" class="control-label">Title:</label>
          <input type="text" class="form-control" id="title" name="title">
          <label for="quantity" class="control-label">Quantity:</label>
          <input type="text" class="form-control" id="quantity" name="quantity">
          <label for="shipping" class="control-label">Shipping:</label>
          <select class="form-control" id="shipping" name="shipping">
            <option value="0" selected="">No</option>
            <option value="1">Yes</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="addCustomLineItem">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#getLineItemByVariantId").click(function(){
        var variant_id = prompt('Please inform the variant id');
        var url = "{{ route('order.lineitem.getvariant', 'variant_id') }}";
        url = url.replace('variant_id', variant_id);
        $.get(url)
        .done(function( response ) {
          alert( "Success: " + JSON.stringify(response) );
        }).fail(function( response ){
          alert( "Error: " + JSON.stringify(response) );
        });
      });
      $("#addLineItemByVariantId").click(function(){
        var variant_id = prompt('Please inform the variant id');
        var url = "{{ route('order.lineitem.createvariant', 'variant_id') }}";
        url = url.replace('variant_id', variant_id);
        $.ajax({
          method: "POST",
          url: url
        })
        .done(function( response ) {
          alert( "Success: " + JSON.stringify(response) );
        }).fail(function( response ){
          alert( "Error: " + JSON.stringify(response) );
        });
      });
      $("#replaceLineItemByVariantId").click(function(){
        var variant_id = prompt('Please inform the variant id');
        var url = "{{ route('order.lineitem.replacevariant', 'variant_id') }}";
        url = url.replace('variant_id', variant_id);
        $.ajax({
          method: "PUT",
          url: url
        })
        .done(function( response ) {
          alert( "Success: " + JSON.stringify(response) );
        }).fail(function( response ){
          alert( "Error: " + JSON.stringify(response) );
        });
      });
      $("#removeLineItemByVariantId").click(function(){
        var variant_id = prompt('Please inform the variant id');
        var url = "{{ route('order.lineitem.removevariant', 'variant_id') }}";
        url = url.replace('variant_id', variant_id);
        $.ajax({
          method: "DELETE",
          url: url
        })
        .done(function( response ) {
          alert( "Success: " + JSON.stringify(response) );
        }).fail(function( response ){
          alert( "Error: " + JSON.stringify(response) );
        });
      });

      $("#addCustomLineItem").click(function(){
        var title = $('#title').val();
        var quantity = $('#quantity').val();
        var shipping = $('#shipping').val();
        if (title == '') {
          alert("Title can't be empty");
          $('#title').focus();
        } else if (quantity == '') {
          alert("Quantity can't be empty");
          $('#quantity').focus();
        } else {
          $.ajax({
            method: "POST",
            url: "{{ route('order.lineitem.createcustom') }}",
            data: { title: title, quantity: quantity,  shipping: shipping }
          }).done(function( response ) {
            alert( "Data posted: " + JSON.stringify(response) );
            $("#customModal").modal('hide');
          }).fail(function( response ){
            alert( "Data error: " + JSON.stringify(response) );
          });
        }
      });
  });
  </script>
</body>

</html>
