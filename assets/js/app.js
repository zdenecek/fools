$(document).ready(function () {
  $("p, dt, dd, span").html(function(index, curr) {
    return curr.replace('♣', "<span class='clubs'>♣</span>")
        .replace('♦', "<span class='diamonds'>♦</span>")
        .replace('♥', "<span class='hearts'>♥</span>")
        .replace('♠', "<span class='spades'>♠</span>")
    
  });
});
