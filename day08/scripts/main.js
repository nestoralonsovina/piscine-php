let gameBoard;

function generateGrid() {
	// Generates a 150x by 100y grid for the game
	let dim = "10px";

	for (let y = 0; y < 100; y++) {
		let row = document.createElement('div');
		row.className = "row row-" + y;
		row.style.height = dim;
		for (let x = 0; x < 150; x++) {
			let cell = document.createElement('div');

			cell.className = "col col-" + x;
			cell.style.width = dim;
			cell.style.height = dim;

			row.appendChild(cell);
		}
		gameBoard.appendChild(row);
	}
}

window.onload = () => {
	gameBoard = document.querySelector(".gameBoard");
	generateGrid();
}
