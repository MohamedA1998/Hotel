$(function () {
    $(document).on("click", "#delete", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        var form_id = $(this).data("formid");

        Swal.fire({
            title: "Are you sure?",
            text: "Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                link !== "#"
                    ? (window.location.href = link)
                    : $("#" + form_id).submit();

                Swal.fire("Deleted!", "Your file has been deleted.", "success");
            }
        });
    });
});
