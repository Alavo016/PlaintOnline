

<!-- Javascript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/zoom.js"></script>
<script src="js/switcher.js"></script>
<script src="js/theme-settings.js"></script>
<script src="js/main.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Activation de DataTables -->
<script>
       $(document).ready(function () {
        $('#tablePlaintes').DataTable({
            "language": {
                "lengthMenu": "Afficher _MENU_ plaintes par page",
                "zeroRecords": "Aucune plainte trouvée",
                "info": "Page _PAGE_ sur _PAGES_",
                "infoEmpty": "Aucune plainte disponible",
                "search": "🔍 Rechercher :",
                "paginate": {
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            },
            "pageLength": 10
        });
    });
</script>
</body>

</html>