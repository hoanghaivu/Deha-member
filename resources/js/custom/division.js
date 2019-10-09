let division = {
    bootstrap: false,
    init: function () {
        if (this.bootstrap) {
            return false;
        }
        this.bootstrap = true;

        $(document).on('click', '.btnDeleteDivision', function () {
            division.deleteDivision(this)
        });

        $(document).on('click', '#btnConfirmDeleteDivision', function () {
            division.confirmDeleteDivision();
        });

    },
    deleteDivision: function (obj) {
        let divisionId = $(obj).data('id');
        let divisionName = $(obj).data('name');
        $('#deleteDivision #divisionId').val(divisionId);
        $('#divisionName').text(divisionName);
        $('#deleteDivision').modal('show');
    },
    confirmDeleteDivision:function () {
        $("#formDeleteDivision").submit();
    },
};

$(document).ready(function () {
    division.init();
});