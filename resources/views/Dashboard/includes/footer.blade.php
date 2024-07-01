  <!-- /.content-wrapper -->
  <footer class="main-footer" style="text-align: center">
    <strong>Copyright &copy; {{getSiteName()}} All rights reserved.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
  <!-- ./wrapper -->

  <script src="{{ asset('theme/dashboard/dist/js/pdfmake.js')}}"></script>
  <script src="{{ asset('theme/dashboard/dist/js/vfs_fonts.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('theme/dashboard/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('theme/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- ChartJS -->
  <script src="{{ asset('theme/dashboard/plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('theme/dashboard/plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('theme/dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{ asset('theme/dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('theme/dashboard/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('theme/dashboard/plugins/moment/moment.min.js')}}"></script>
  <script src="{{ asset('theme/dashboard/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('theme/dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('theme/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

  <!-- DataTables  & Plugins -->
  <script src="{{asset('theme/dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('theme/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('theme/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('theme/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('theme/dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('theme/dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('theme/dashboard/plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{asset('theme/dashboard/plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{asset('theme/dashboard/plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{asset('theme/dashboard/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('theme/dashboard/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('theme/dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
  <script src="{{asset('theme/dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
  <script src="{{asset('theme/dashboard/dist/js/myjs.js')}}"></script>

  <script>
      var table1 = $('#example1').DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,
          "buttons": ["excel", "print", "colvis"],
          "oLanguage": {
              "sSearch": "{{__('admin.search')}} : ",
              "sLoadingRecords": "{{__('admin.loading')}}",
              "sInfoEmpty": "{{__('admin.no_result')}}",
              "sEmptyTable": "{{__('admin.no_result')}}"
          },

          'buttons': [
              {
                  extend: 'excel', text: '{{__('admin.excel')}}'
              },
              {
                  extend: 'print', text: '{{__('admin.print')}}'
              },
              {
                  extend: 'colvis', text: '{{__('admin.column_visibility')}}'
              },
          ],
          "language": {
              "paginate": {
                  "previous": "{{__('admin.previous')}}",
                  "next": "{{__('admin.next')}}",
              }
          },
  });
  </script>
  <!--end data table-->

  <!-- Select2 -->
  <script src="{{ asset('theme/dashboard/plugins/select2/js/select2.full.min.js')}}"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="{{ asset('theme/dashboard/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
  <!-- InputMask -->
  <script src="{{ asset('theme/dashboard/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
  <!-- bootstrap color picker -->
  <script src="{{ asset('theme/dashboard/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
  <!-- Bootstrap Switch -->
  <script src="{{ asset('theme/dashboard/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
  <!-- BS-Stepper -->
  <script src="{{ asset('theme/dashboard/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
  <!-- dropzonejs -->
  <script src="{{ asset('theme/dashboard/plugins/dropzone/min/dropzone.min.js')}}"></script>
  <!-- Page specific script -->
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date picker
      $('#reservationdate').datetimepicker({
          format: 'L'
      });

      //Date and time picker
      $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })

      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      })

      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })

    })
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
      url: "/target-url", // Set the url
      thumbnailWidth: 80,
      thumbnailHeight: 80,
      parallelUploads: 20,
      previewTemplate: previewTemplate,
      autoQueue: false, // Make sure the files aren't queued until manually added
      previewsContainer: "#previews", // Define the container to display the previews
      clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })

    myDropzone.on("addedfile", function(file) {
      // Hookup the start button
      file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
      document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function(file) {
      // Show the total progress bar when upload starts
      document.querySelector("#total-progress").style.opacity = "1"
      // And disable the start button
      file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
      document.querySelector("#total-progress").style.opacity = "0"
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
      myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
      myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
  </script>
</body>
</html>
