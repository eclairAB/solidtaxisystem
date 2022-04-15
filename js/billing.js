var modal = document.getElementById("myModal");

// var btn = document.getElementById("myBtn");

var span = document.getElementsByClassName("close")[0];

// btn.onclick = function() {
//   modal.style.display = "block";
// }

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function cashierBillingOnZeroes() {
	const element = document.querySelector("table.cart tbody tr:last-child")
	if(element) {
		const price = element.children[1].innerHTML
		if (parseFloat(price) <= 0) {
			console.log(123)
			modal.style.display = "block";
		}
	}
}

cashierBillingOnZeroes()
console.log(123, modal)