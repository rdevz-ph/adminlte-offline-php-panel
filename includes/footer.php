<footer class="main-footer">
    <strong>&copy; <?= date('Y') ?> <a href="#"><?= $system_name ?: 'Admin Panel' ?></a>.</strong> All rights reserved.
</footer>
</div>

<script src="../assets/plugins/jquery/jquery.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/dist/js/adminlte.min.js"></script>

<!-- DataTables & Plugins -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/plugins/jszip/jszip.min.js"></script>
<script src="../assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const params = new URLSearchParams(window.location.search);
        const toast = document.getElementById("adminToast");
        const toastBody = document.getElementById("toast-body-text");
        const toastTitle = document.getElementById("toast-title");

        if (params.has("success")) {
            toast.classList.remove("bg-danger");
            toast.classList.add("bg-success");
            toast.querySelector(".toast-header").classList.remove("bg-danger");
            toast.querySelector(".toast-header").classList.add("bg-success");
            toastTitle.innerHTML = `<i class="fas fa-check-circle mr-2"></i>Success`;
            toastBody.textContent = params.get("success").replace(/\+/g, ' ');
            $(toast).toast({ delay: 5000 }).toast("show");
        } else if (params.has("error")) {
            toast.classList.remove("bg-success");
            toast.classList.add("bg-danger");
            toast.querySelector(".toast-header").classList.remove("bg-success");
            toast.querySelector(".toast-header").classList.add("bg-danger");
            toastTitle.innerHTML = `<i class="fas fa-exclamation-circle mr-2"></i>Error`;
            toastBody.textContent = params.get("error").replace(/\+/g, ' ');
            $(toast).toast({ delay: 5000 }).toast("show");
        }
    });
</script>

<script>
    $(function () {
        $("#userTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#userTable_wrapper .col-md-6:eq(0)');
    });


    // Users
    $(document).ready(function () {
        $('.edit-btn').on('click', function () {
            $('#edit-id').val($(this).data('id'));
            $('#edit-name').val($(this).data('name'));
            $('#edit-username').val($(this).data('username'));
            $('#edit-user-type').val($(this).data('user_type'));
        });
    });

</script>

</body>

</html>