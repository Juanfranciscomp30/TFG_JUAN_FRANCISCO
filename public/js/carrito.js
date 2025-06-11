$(".eliminar-form").on("submit", function (e) {
    e.preventDefault();
    let form = $(this);
    let id = form.data("id");
    let card = $(".card-item-" + id);
    card.animate({ opacity: 0, marginLeft: "100px" }, 400, function () {
        form.unbind("submit").submit(); // Ahora sí lanza el submit normal
    });
});

$(document).ready(function () {
    $(".actualizar-cantidad").on("click", function () {
        let id = $(this).data("id");
        let input = $('.cantidad-input[data-id="' + id + '"]');
        let cantidad = parseInt(input.val());
        let token =
            $('meta[name="csrf-token"]').attr("content") ||
            "{{ csrf_token() }}";

        $.ajax({
            url: "/carrito/actualizar",
            method: "POST",
            data: { id: id, cantidad: cantidad, _token: token },
            success: function (response) {
                if (response.success) {
                    $("#subtotal-" + id).html(
                        '<i class="fa-solid fa-money-bill"></i> Subtotal: €' +
                            response.subtotal.toFixed(2)
                    );
                    let total = 0;
                    $(".subtotal").each(function () {
                        let texto = $(this).text();
                        let match = texto.match(/€([\d\.,]+)/);
                        if (match) {
                            let num = parseFloat(match[1].replace(",", "."));
                            total += num;
                        }
                    });
                    $(".total-cesta").html("Total: €" + total.toFixed(2));
                } else {
                    alert(response.error || "Error al actualizar la cantidad");
                }
            },
        });
    });
});
