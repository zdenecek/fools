$(document).ready(function () {
  $("p, dt, dd, span, td, a, h1, h2, h2, h3, h4, h5, h6").html(function(index, curr) {
    return curr.replaceAll('♣', "<span class='clubs'>♣</span>")
        .replaceAll('♦', "<span class='diamonds'>♦</span>")
        .replaceAll('♥', "<span class='hearts'>♥</span>")
        .replaceAll('♠', "<span class='spades'>♠</span>")
  });
});
