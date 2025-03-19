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
    $(document).ready(function() {
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

    function previewFile(event) {
        let fileInput = event.target;
        let filePreview = document.getElementById('filePreview');
        filePreview.innerHTML = ''; // Nettoyer l'aperçu précédent

        if (fileInput.files.length > 0) {
            let file = fileInput.files[0];
            let reader = new FileReader();

            reader.onload = function(e) {
                let fileType = file.type.split('/')[0];

                if (fileType === 'image') {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    filePreview.appendChild(img);
                } else {
                    let fileInfo = document.createElement('div');
                    fileInfo.className = 'file-info';
                    fileInfo.innerHTML = `<strong>${file.name}</strong> <br> (${(file.size / 1024).toFixed(2)} KB)`;
                    filePreview.appendChild(fileInfo);
                }
            };

            reader.readAsDataURL(file);
        }
    }
</script>
</body>

</html>