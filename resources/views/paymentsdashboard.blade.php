@extends('layouts.app')
@include('layouts.navpayments')
@section('content')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-md-center" id="navbarCollapse">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#newPaymentModal">New Payment</a>
      </li>
    </ul>

  </div>
</nav>

<div class="divider-50"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  Dashboard
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="display compact" style="width: 100%" id="payments-table">
                      <thead>
                        <tr>
                          <th class="align-middle">#</th>
                          <th class="align-middle">Title</th>
                          <th class="align-middle">Firstname</th>
                          <th class="align-middle">Lastname</th>
                          <th class="align-middle">Type</th>
                          <th class="align-middle">Language</th>
                          <th class="text-right align-middle">Created</th>
                          <th class="text-right align-middle">Total €</th>
                          <th class="text-left align-middle">Brand</th>
                          <th class="text-right align-middle">4 Digits</th>
                          <th class="text-right align-middle">Access</th>
                          <th class="text-right align-middle">Status</th>
                          <th class="text-right align-middle">User</th>
                          <th class="text-right align-middle">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div><!-- END CARD BODY -->
            </div><!-- END CARD -->
        </div><!-- END COL MD 12 -->
    </div><!-- END ROW -->
</div><!-- END CONTAINTER -->

<form id="newPaymentForm" class="" action="/payment" method="post">
  {{ csrf_field() }}
  <div class="modal fade" id="newPaymentModal" tabindex="-1" role="dialog" aria-labelledby="newReservationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newPaymentModalLabel">New Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!-- END MODAL HEADER -->

      <div class="modal-body">

        <div class="form-group">
          <input type="text" class="form-control input-lg" id="title" name="title" placeholder="Title">
        </div>

        <div class="form-group">
          <select class="form-control input-lg" id="salutation" name="salutation" required="">
            @foreach ($paymentsSalutation as $salut)
              <option value="{{ $salut->salutationID }}">{{ $salut->salutation }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <input type="text" class="form-control input-lg" id="firstname" name="firstname" placeholder="Firstname" required>
        </div>

        <div class="form-group">
          <input type="text" class="form-control input-lg" id="lastname" name="lastname" placeholder="Lastname" required>
        </div>

        <div class="form-group">
          <input type="email" class="form-control input-lg" id="email" name="email" placeholder="E-Mail" required>
        </div>

        <div class="form-group">
          <select class="form-control input-lg" id="language" name="language" required="">
            <option value="">Choose Language</option>
            <option value="de">German</option>
            <option value="en">English</option>
            <option value="es">Spanish</option>
          </select>
        </div>

        <div class="form-group">
          <select class="form-control input-lg" id="type" name="type" required="">
            <option value="">Choose Type</option>
            <option value="room">Room Booking</option>
            <option value="authorization">Billing Authorization</option>
          </select>
        </div>

        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="total-addon">&euro;</span>
          </div>
          <input type="number" class="form-control input-lg" id="total" name="total" placeholder="Total" min="0.00" max="999999.00" step="0.01" required aria-label="Total" aria-describedby="total-addon">
        </div>

      </div><!-- END MODAL BODY -->

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Close
        </button>
        <input type="hidden" name="user" id="user" value="{{ Auth::id() }}">
        <input type="submit" class="btn btn-primary" id="submitButton" value="Create">
      </div><!-- END MODAL FOOTER -->

    </div><!-- END MODAL CONTENT -->
  </div>
</div><!-- END MODAL -->
</form>

<!-- MODAL SHOW LINK -->
<div class="modal fade" id="showLinkModal" tabindex="-1" role="dialog" aria-labelledby="showLinkModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showLinkModalLabel">Payment Invitation Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="showUniqlink" class="col-form-label">Link:</label>
          <input class="form-control" type="text" name="showUniqlink" id="showUniqlink" value="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div><!-- END MODAL SHOW LINK -->

<!-- MODAL RESEND LINK -->
<form id="resendForm" class="" action="/resendPayment" method="post">
{{ csrf_field() }}
  <div class="modal fade" id="resendRecordModal" tabindex="-1" role="dialog" aria-labelledby="resendRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="resendRecordModalLabel">Resend Invitation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-warning">
            Resend following Invitation?
          </div>
          <div class="form-group">
            <input type="text" class="form-control input-lg" id="showFirstname" name="showFirstname" placeholder="Firstname" disabled>
          </div>
          <div class="form-group">
            <input type="text" class="form-control input-lg" id="showLastname" name="showLastname" placeholder="Lastname" disabled>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="total-addon">&euro;</span>
            </div>
            <input type="number" class="form-control input-lg" id="showTotal" name="showTotal" placeholder="Total" min="0.00" max="999999.00" step="0.01" required aria-label="Total" aria-describedby="total-addon" disabled>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="hidden" name="showPaymentIDresend" id="showPaymentIDresend" value="">
          <input type="hidden" name="showLink" id="showLink" value="">
          <input type="hidden" name="showTitle" id="showTitle" value="">
          <input type="hidden" name="showSalutation" id="showSalutation" value="">
          <input type="hidden" name="showEmail" id="showEmail" value="">
          <input type="hidden" name="showLanguage" id="showLanguage" value="">
          <input type="hidden" name="showType" id="showType" value="">
          <input type="submit" class="btn btn-primary" id="submitResendButton" value="Yes, resend">
        </div>
      </div>
    </div>
  </div><!-- END MODAL RESEND LINK -->
</form>

<!-- MODAL EDIT RECORD -->
<form id="editForm" class="" action="/editPayment" method="post">
{{ csrf_field() }}
  <div class="modal fade" id="editRecordModal" tabindex="-1" role="dialog" aria-labelledby="editRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editRecordModalLabel">Edit Record</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-warning">
            Changes cannot be made to Language and Payment Type.<br>They are integral parts of the payment invitation link.
          </div>
          <div class="form-group">
            <input type="text" class="form-control input-lg" id="showTitle" name="showTitle" placeholder="Title">
          </div>
          <div class="form-group">
            <select class="form-control input-lg" id="showSalutation" name="showSalutation" required="">
              @foreach ($paymentsSalutation as $salut)
                <option value="{{ $salut->salutationID }}">{{ $salut->salutation }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control input-lg" id="showFirstname" name="showFirstname" placeholder="Firstname" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control input-lg" id="showLastname" name="showLastname" placeholder="Lastname" required>
          </div>
          <div class="form-group">
            <input type="email" class="form-control input-lg" id="showEmail" name="showEmail" placeholder="E-Mail" required>
          </div>
          <div class="form-group">
            <select class="form-control input-lg" id="showLanguage" name="showLanguage" required="" disabled>
              <option value="">Choose Language</option>
              <option value="de">German</option>
              <option value="en">English</option>
              <option value="es">Spanish</option>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control input-lg" id="showType" name="showType" required="" disabled>
              <option value="">Choose Type</option>
              <option value="room">Room Booking</option>
              <option value="authorization">Billing Authorization</option>
            </select>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="total-addon">&euro;</span>
            </div>
            <input type="number" class="form-control input-lg" id="showTotal" name="showTotal" placeholder="Total" min="0.00" max="999999.00" step="0.01" required aria-label="Total" aria-describedby="total-addon">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="hidden" name="showPaymentIDedit" id="showPaymentIDedit" value="">
          <input type="hidden" name="userLastEdit" id="userLastEdit" value="{{ Auth::id() }}">
          <input type="submit" class="btn btn-primary" id="submitEditButton" value="Save">
        </div>
      </div>
    </div>
  </div><!-- END MODAL EDIT RECORD -->
</form>

<!-- MODAL DELETE LINK -->
<form id="deleteForm" class="" action="/deletePayment" method="post">
{{ csrf_field() }}
  <div class="modal fade" id="deleteRecordModal" tabindex="-1" role="dialog" aria-labelledby="deleteRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteRecordModalLabel">Delete Record</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger">
            Delete following record?
          </div>
          <div class="form-group">
            <input type="text" class="form-control input-lg" id="showFirstname" name="showFirstname" placeholder="Firstname" disabled>
          </div>
          <div class="form-group">
            <input type="text" class="form-control input-lg" id="showLastname" name="showLastname" placeholder="Lastname" disabled>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="total-addon">&euro;</span>
            </div>
            <input type="number" class="form-control input-lg" id="showTotal" name="showTotal" placeholder="Total" min="0.00" max="999999.00" step="0.01" required aria-label="Total" aria-describedby="total-addon" disabled>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="hidden" name="showPaymentID" id="showPaymentID" value="">
          <input type="hidden" name="userSoftDelete" id="userSoftDelete" value="{{ Auth::id() }}">
          <input type="submit" class="btn btn-primary" id="submitDeleteButton" value="Yes, delete">
        </div>
      </div>
    </div>
  </div><!-- END MODAL DELETE LINK -->
</form>

<script>
  $(document).ready(function() {
    $('#newPaymentForm').submit(function() {
      $('#submitButton')
      .val('Wird erstellt...')
      .prop('disabled', true);
    })

  });

  $('#showLinkModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var link   = button.data('link')
    var modal  = $(this)
    modal.find('.modal-body input').val(link)
  })

  $('#editRecordModal').on('show.bs.modal', function(event) {
    var button     = $(event.relatedTarget)
    var link       = button.data('paymentidedit')
    var title      = button.data('title')
    var salutation = button.data('salutation')
    var firstname  = button.data('firstname')
    var lastname   = button.data('lastname')
    var email      = button.data('email')
    var language   = button.data('language')
    var type       = button.data('type')
    var total      = button.data('total')
    var modal      = $(this)
    modal.find('.modal-footer input[name=showPaymentIDedit]').val(link)
    modal.find('.modal-body input[name=showTitle]').val(title)
    modal.find('.modal-body select[name=showSalutation]').val(salutation)
    modal.find('.modal-body input[name=showFirstname]').val(firstname)
    modal.find('.modal-body input[name=showLastname]').val(lastname)
    modal.find('.modal-body input[name=showEmail]').val(email)
    modal.find('.modal-body select[name=showLanguage]').val(language)
    modal.find('.modal-body select[name=showType]').val(type)
    modal.find('.modal-body input[name=showTotal]').val(total)
  })

  $('#deleteRecordModal').on('show.bs.modal', function(event) {
    var button    = $(event.relatedTarget)
    var link      = button.data('paymentid')
    var firstname = button.data('firstname')
    var lastname  = button.data('lastname')
    var total     = button.data('total')
    var modal     = $(this)
    modal.find('.modal-footer input[name=showPaymentID]').val(link)
    modal.find('.modal-body input[name=showFirstname]').val(firstname)
    modal.find('.modal-body input[name=showLastname]').val(lastname)
    modal.find('.modal-body input[name=showTotal]').val(total)
  })

  $('#resendRecordModal').on('show.bs.modal', function(event) {
    var button     = $(event.relatedTarget)
    var id         = button.data('paymentidresend')
    var link       = button.data('link')
    var title      = button.data('title')
    var salutation = button.data('salutation')
    var email      = button.data('email')
    var language   = button.data('language')
    var type       = button.data('type')
    var firstname  = button.data('firstname')
    var lastname   = button.data('lastname')
    var total      = button.data('total')
    var modal      = $(this)
    modal.find('.modal-footer input[name=showPaymentIDresend]').val(id)
    modal.find('.modal-footer input[name=showLink]').val(link)
    modal.find('.modal-footer input[name=showTitle]').val(title)
    modal.find('.modal-footer input[name=showSalutation]').val(salutation)
    modal.find('.modal-footer input[name=showEmail]').val(email)
    modal.find('.modal-footer input[name=showLanguage]').val(language)
    modal.find('.modal-footer input[name=showType]').val(type)

    modal.find('.modal-body input[name=showFirstname]').val(firstname)
    modal.find('.modal-body input[name=showLastname]').val(lastname)
    modal.find('.modal-body input[name=showTotal]').val(total)
  })

  $(function() {
    $('#payments-table').DataTable({
      processing: true,
      serverSide: true,
      order: [[0, 'desc' ]],
      ajax: '{{ route('payments-dt') }}',
      columns: [
        { data: 'paymentid', name: 'paymentid' },
        { data: 'title', name: 'title' },
        { data: 'firstname', name: 'firstname' },
        { data: 'lastname', name: 'lastname' },
        { data: 'type', name: 'type' },
        { data: 'language', name: 'language' },
        { data: 'created_at', name: 'created_at' },
        { data: 'total', name: 'total', render: $.fn.DataTable.render.number('.', ',', 2, '€ ' ) },
        { data: 'paymentbrand', name: 'paymentbrand' },
        { data: 'paymentlast4', name: 'paymentlast4' },
        { data: 'paymentaccess', name: 'paymentaccess' },
        { data: 'paymentstatus', render: function (data, type, row)
            {
              switch (row.paymentstatus)
              {
                case 'error':
                titleMessage = row.stripeerrormessage;
                break;

                case 'opened':
                titleMessage = row.paymentopendate;
                break;

                case 'paid':
                titleMessage = row.paymentdate;
                break;

                default:
                titleMessage = "";
              }
              return '<a href="#" data-toggle="tooltip" data-placement="top" title="' + titleMessage + '">' + row.paymentstatus + '</a>'
            }
        },
        { data: '_user', name: '_user' },
        { data: 'action', name: 'action', orderable: false, searchable: false },
      ],
      columnDefs: [
        { className: 'text-right', 'targets': [5,6,7,10,11,12,13] },
        { 'width': '5px', 'targets': [0,1,13] },
      ]
    });
  })
</script>

@endsection
