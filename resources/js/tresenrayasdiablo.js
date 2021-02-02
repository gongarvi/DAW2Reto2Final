require("./bootstrap.js");

var model, view;
var controller = new Controller();
controller.init();

function Model() {
	var self = this;
	
	/* Funcion de poner human/computer a X/O */
	self.setPieces = function(human, cpu) {
		self.humanPiece = human;
		self.cpuPiece = cpu;
	};
	
	/* Funcion resetear juego */
	self.resetGame = function() {
		// Resetea todos los variables del juego a sus valores iniciales.
		resetTiles();
		self.winningTile = [];				//for ai calcs
		self.blockingTile = [];				//for ai calcs
		self.humanPlays = [];				//for ai calcs
		self.turn = 1;
		self.victoryTiles = [];
		// Selecciona un jugador BOT (llamando la funcion).
		self.humanTurn = randomTurn();
		
		/* Funcion resetear el titulo */
		function resetTiles() {
			self.arrTiles = [];
			for (var i = 0; i < 3; i++) {
				var innerArray = [];
				for (var j = 0; j < 3; j++) {
					// Rellena las cajas con valores vacillos
					innerArray.push('');
				}
				self.arrTiles.push(innerArray);
			}
		}
		
		/* Funcion Los turnos del BOT */
		function randomTurn() {
			// recogo valores aleatorios hasta 10
			var rand = Math.floor(Math.random() * 10);

			// Devuelve a BOT para hacer el primer movimiento
			if (rand >= 5) {
				return true;
			}
			return false;
		}
	};

	/* Flujo del juego */
	
	/* function getTurn
	 *
	 * Returns total moves made so far (starts at 1)
	 * Useful for checking victory conditions
	*/
	self.getTurn = function() {
		return self.turn;
	};

	/* function switchTurn
	 *
	 * Switch between player and computer
	*/
	self.switchTurn = function() {
		self.turn++;
		self.humanTurn = !self.humanTurn;
	};
	
	/* function getHumanTurn
	 *
	 * Returns whether its the human or computer's turn
	*/
	self.getHumanTurn = function() {
		return self.humanTurn;
	};

	/* function getCurrentPiece
	 *
	 * returns the piece (x/o) of the current player
	*/
	self.getCurrentPiece = function() {
		if (self.humanTurn) {
			return self.humanPiece;
		}
		
		return self.cpuPiece;
	};

	/*
	 *
	 * Making moves / placing tiles
	 *
	*/	
	
	/* function isTileEmpty
	 *
	 * Checks to see if a piece is already in a tile.  (Play validation)
	*/
	self.isTileEmpty = function(coords) {
		if (self.arrTiles[coords[0]][coords[1]] === '') {
			return true;
		}
		
		return false;
	};

	/* function saveHumanPlays
	 *
	 * Keeps track of the early human moves (to handle special AI cases)
	*/
	self.saveHumanPlays = function(coords) {
		self.humanPlays.push(coords);
	};
	
	/* function updateTile
	 *
	 * Fills a tile with a player piece and handles some AI calculations if the tile
	 * that was played on was a critical one for the computer.
	 * (The loops are because there are cases where there could be more than one winning tile, for example)
	*/
	self.updateTile = function(coords) {
		self.arrTiles[coords[0]][coords[1]] = self.getCurrentPiece();

		for (var i = 0; i < self.winningTile.length; i++) {
			if (self.winningTile[i][0] === coords[0] && self.winningTile[i][1] === coords[1]) {
				self.winningTile.splice(i, 1);
				break;
			}
		}

		for (var i = 0; i < self.blockingTile.length; i++) {
			if (self.blockingTile[i][0] === coords[0] && self.blockingTile[i][1] === coords[1]) {
				self.blockingTile.splice(i, 1);
				break;
			}
		}
		
		self.checkForCriticalTile(coords);
	};

	/*
	 *
	 * AI Calculations
	 *
	*/
	
	/* function checkForCriticalTile
	 *
	 * A key part of the computer's strategy.  Checks for impending 'bingos' (3-in-a-row/col/diag)
	 * and updates critical tiles (can end the game if played by same player on next turn).
	 *
	*/
	self.checkForCriticalTile = function(coords) {
		var criticalTile = getCriticalTile();
		if (!self.humanTurn) {
			self.winningTile = criticalTile;
		}
		else {
			self.blockingTile = criticalTile;
		} 

		/* function getCriticalTile
		 *
		 * A critical tile is a tile such as the _ in: x _ x
		 * If player x fills in the empty space on his next turn, he'll end the game.
		 * Thus, if x is the computer, that middle square is a winnable Tile.
		 * If x is the human, then the middle square is one that must be blocked immediately
		*/		
		function getCriticalTile() {
			var piece = self.getCurrentPiece();	
			var possibleTile = [];
			
			checkMyRow();
			checkMyCol();
			checkMyDiags();

			return possibleTile;
			
			function checkMyRow() {
				var counter = 0;
				var possibleX = -1;
				
				for (var i = 0; i < 3; i++) {
					if (self.arrTiles[i][coords[1]] === piece) {
						counter++;
					}
					else if (self.arrTiles[i][coords[1]] === '') {
						possibleX = i;
					}
				}

				if (counter === 2 && possibleX !== -1) {
					possibleTile.push([possibleX, coords[1]]);
				}
			}

			function checkMyCol() {
				var counter = 0;
				var possibleY = -1;
				for (var j = 0; j < 3; j++) {
					if (self.arrTiles[coords[0]][j] === piece) {
							counter++;
					}
					else if (self.arrTiles[coords[0]][j] === '') {
						possibleY = j;
					}
				}

				if (counter === 2 && possibleY !== -1) {
					possibleTile.push([coords[0], possibleY]);
				}
			}

			function checkMyDiags() {
				var diff = coords[0] - coords[1];

				checkSlash();
				checkBackSlash();

				function checkSlash() {
					var counter = 0;
					var possibleI = -1;
					
					if (diff === 0) {
						for (var i = 0; i < 3; i++) {
							if (self.arrTiles[i][i] === piece) {
								counter++;
							}
							else if (self.arrTiles[i][i] === '') {
								possibleI = i;
							}
						}

						if (counter === 2 && possibleI !== -1) {
							possibleTile.push([possibleI, possibleI]);
						}
					}
				}

				function checkBackSlash() {
					var counter = 0;
					var possibleX = -1;
					var possibleY = -1;
					
					if (diff === 2 || diff === 0 || diff === -2) {
						var j = 2;
						for (var i = 0; i < 3; i++) {
							if (self.arrTiles[i][j] === piece) {
								counter++;
							}
							else if (self.arrTiles[i][j] === '') {
								possibleX = i;
								possibleY = j;
							}
							j--;
						}
						
						if (counter === 2 && possibleX !== -1) {
							possibleTile.push([possibleX, possibleY]);
						}
					}
				} //checkBackSlash
			} //checkMyDiags
		} //getCriticalTile
	} //checkForCriticalTile
	
	/* function aiTileSelection
	 *
	 * Chooses a tile based on the following strategy:
	 * 0. (Handle a few special cases)
	 * 1. Play a winning move
	 * 2. Play a blocking move
	 * 3. Take center
	 * 4. Take a corner
	 * 5. Play remaining
	*/
	self.aiTileSelection = function() {
		/* 0. Handle various special cases */
		if (self.turn === 1) {	//cpu plays first
			return self.chooseRandomFromSet('center-corners');
		}
		else if (self.turn === 2) {  //human played first
			if (checkHumanMove(0) === 'side') {
				return self.chooseRandomFromSet('adjacent-corners');
			}
		}
		else if (self.turn === 4 && checkHumanMove(0) === 'corner') {  //human 1st played corner
			var move2 = checkHumanMove(1);
			if (move2 === 'opp-corner') {
				return self.chooseRandomFromSet('side');
			}
			else if (move2 === 'adj-opp-corner') {
				var oppX = self.humanPlays[0][0] + 2;
				var oppY = self.humanPlays[0][1] + 2;
				if (oppX > 2) {
					oppX = 0;
				}

				if (oppY > 2) {
					oppY = 0;
				}

				return [oppX, oppY];	//then must take that opp-corner
			}
		}
		/* End handling of special cases */

		/* 1. Play a winning move */
		if (self.winningTile.length !== 0) {
			return self.winningTile[0];
		}

		/* 2. Play a blocking move */
		if (self.blockingTile.length !== 0) {
			return self.blockingTile[0];
		}

		/* 3. Take center */
		if (self.arrTiles[1][1] === '') {
			return [1, 1];
		}

		/* 4. Take a corner */
		var tile = self.chooseRandomFromSet('corners');
		if (tile) {
			return tile;
		}

		/* 5. Take a remaining tile */
		return self.chooseRandomFromSet('all');

		/* function checkHumanMove
		 *
		 * All the special cases the AI must handle are based on the inital moves the
		 * human makes.  This determines the type of move the human made.
		*/
		function checkHumanMove(index) {
			if (index === 0) {	//first turn
				var coords = self.humanPlays[0];
				if (coords[0] === 0 && coords[1] === 0 ||
					coords[0] === 0 && coords[1] === 2 ||
					coords[0] === 2 && coords[1] === 0 ||
					coords[0] === 2 && coords[1] === 2) {
					return 'corner';
				}
				else if (coords[0] === 1 && coords[1] === 1) {
					return 'center';
				}
				else {
					return 'side';
				}
			}
			else {	//second move
				//See if human played the opposite corner
				var coords = self.humanPlays[0];
				var x1 = coords[0];
				var y1 = coords[1];
				coords = self.humanPlays[1];
				var x2 = coords[0];
				var y2 = coords[1];

				var oppX = x1 + 2;
				var oppY = y1 + 2;
				if (oppX > 2) {
					oppX = 0;
				}

				if (oppY > 2) {
					oppY = 0;
				}

				if (oppX === x2 && oppY === y2) {
					return 'opp-corner';
				}

				//See if human played adjacent to opp corner
				if (oppX === x2 && y2 === 1) {
					return 'adj-opp-corner';
				}
				if (oppY === y2 && x2 === 1) {
					return 'adj-opp-corner';
				}
			}
		}
	};

	/* function chooseRandomFromSet
	 *
	 * Based on the provided set name, looks for an empty tile within that set and selects
	 * one at random.
	*/
	self.chooseRandomFromSet = function(setName) {
		var set;
		if (setName === 'corners') {
			set = [[0, 0], [0, 2], [2, 0], [2, 2]];
		}
		else if (setName === 'side') {
			set = [[1, 0], [0, 1], [2, 1], [1, 2]];
		}
		else if (setName === 'center-corners') {
			set = [[0, 0], [0, 2], [1, 1], [2, 0], [2, 2], [1, 1]];
		}
		else if (setName === 'all') {
			set = [[0, 0], [0, 1], [0, 2], [1, 0], [1, 1], [1, 2], [2, 0], [2, 1], [2, 2]];
		}
		else if (setName === 'adjacent-corners') {
			var x = self.humanPlays[0][0];
			if (x !== 1) {
				set = [[x, 0], [x, 2]];
			}
			else {
				var y = self.humanPlays[0][1];
				set = [[0, y], [2, y]];
			}
		}

		var emptyTiles = [];

		for (var i = 0; i < set.length; i++) {
			if (self.arrTiles[set[i][0]][set[i][1]] === '') {
				emptyTiles.push(set[i]);
			}
		}

		if (emptyTiles.length === 0) {
			return false;
		}
		
		var max = emptyTiles.length;
		var min = 0;
		var randIndex =	Math.floor(Math.random() * (max - min) + min);
		
		return emptyTiles[randIndex];		
	};

	/*
	 *
	 * End of game
	 *
	*/
	
	/* function isVictory
	 *
	 * Based on the tile just played in, checks in all directions for
	 * 3-in-a-row by the same player.  If bingo, also updates the victoryTiles
	 * array so that the winning tiles can be recolored by the View.
	 *
	 * (This was how the game originally worked before strategic AI.  Likely somewhat 
	 * redundant now.)
	*/
	self.isVictory = function(coords) {
		var piece = self.getCurrentPiece();
		
		return checkMyRow() || checkMyCol() || checkMyDiags() || checkForTie();
		
		function checkMyRow() {
			for (var i = 0; i < 3; i++) {
				if (self.arrTiles[i][coords[1]] !== piece) {
					return false;
				}
			}
			
			for (var i = 0; i < 3; i++) {
				self.victoryTiles.push([i, coords[1]]);
			}
			return true;
		}
		
		function checkMyCol() {
			for (var j = 0; j < 3; j++) {
				if (self.arrTiles[coords[0]][j] !== piece) {
					return false;
				}
			}
			
			for (var j = 0; j < 3; j++) {
				self.victoryTiles.push([coords[0], j]);
			}
			return true;
		}
		
		function checkMyDiags() {
			var diff = coords[0] - coords[1];
			
			return checkSlash() || checkBackSlash();
			
			function checkSlash() {
				if (diff === 0) {
					for (var i = 0; i < 3; i++) {
						if (self.arrTiles[i][i] !== piece) {
							return false;
						}
					}
					
					for (var i = 0; i < 3; i++) {
						self.victoryTiles.push([i, i]);
					}
					return true;
				}
				
				return false;
			}
			
			function checkBackSlash() {
				if (diff === 2 || diff === 0 || diff === -2) {
					var j = 2;
					for (var i = 0; i < 3; i++) {
						if (self.arrTiles[i][j] !== piece) {
							return false;
						}
						j--;
					}
					
					j = 2;
					for (var i = 0; i < 3; i++) {
						self.victoryTiles.push([i, j]);
						j--;
					}
					return true;
				}
				
				return false;
			}
		}
		
		/* function checkForTie
		 *
		 * A tie... counts as a victory in that it's a game over...
		*/
		function checkForTie() {
				if (model.turn >= 9) {
					return true;
				}
				
				return false;
			}
	};
	
	self.getVictoryTiles = function() {
		return self.victoryTiles;
	}
}

function View() {
	var self = this;
	self.board = $('.game-board');
	
	/* function init
	 *
	 * Sets up the listeners on the player piece selection screen.
	 * !!!!!!!
	 * The setTimeout is to prevent an issue where the user is
	 * unable to click on the tile that is 'underneath' the
	 * piece selection div that was clicked on yet removed in the
	 * buildBoard function.  My guess is that the bug arises because
	 * the 'on' event is still firing when its element gets deleted.
	 * Thus, wait for the 'on' event to finish, then delete the element.
	 * !!!!!!!
	*/
	self.init = function() {
		$('#X').on('mousedown', function() {
			setTimeout(function() {
				controller.firstGame('X');
			}, 100);
		});
		
		$('#O').on('mousedown', function() {
			setTimeout(function() {
				controller.firstGame('O');
			}, 100);		
		});
	}
	
	/* function removeSelectionScreen
	 *
	 * This is potentially redundant, but it feels safer to explicitly
	 * remove the listeners attached to the selection screen.
	*/
	self.removeSelectionScreen = function() {
		$('.choice').remove();
	};
	
	/* function buildBoard 
	 * 
	 * Clears the board and then creates the div tiles that make up board
	*/
	self.buildBoard = function() {
		self.board.html('');
		for (var i = 0; i < 9; i++) {
			self.board.append('<div class="tile" id="' + i + '"></div>');
		}
	};
	
	/* function setUpListener 
	 * 
	 * Listens for both clicks and touches on the game board
	*/
	self.setUpListener = function() {
		self.board.on('mousedown', '.tile', function(e) {
			controller.clickedTile($(this).attr('id'));			
		});
		
		self.board.on('touchend', '.tile', function(e) {
			e.preventDefault();
			controller.clickedTile($(this).attr('id'));
		});
	}
	
	/* function renderPiece
	 *
	 * Draws a game piece over a tile.
	 * Takes the piece type (X/O) and the tile's id
	*/
	self.renderPiece = function(type, id) {
		$('#' + id).html('<p class="piece">' + type + '</p>');
	};
	
	/* function highlightTiles
	 *
	 * Upon game over, colors the winning pieces yellow
	 * or colors all the tying pieces red.
	*/
	self.highlightTiles = function(elems) {
		var className = 'highlight';
		if (elems.length > 3) {
			className = 'redlight';
		}
		
		var len = elems.length;
		for (var i = 0; i < len; i++) {
			$('#' + elems[i]).addClass(className);
		}
	};
}

function Controller() {
	var self = this;
	
	/* function init
	 *
	 * Initialize all of the MVC
	*/
	self.init = function() {
		model = new Model();
		view = new View();
		view.init();
	};
	
	/* function firstGame
	 *
	 * The very first game requires some additional setup: game pieces, listeners
	*/	
	self.firstGame = function(humanPiece) {
		var computerPiece = 'X';
		if (humanPiece === 'X') {
			computerPiece = 'O';
		}
		
		view.removeSelectionScreen();
		model.setPieces(humanPiece, computerPiece);
		view.setUpListener();
		self.newGame();
	}
	
	/* function newGame
	 *
	 * Clear the board and start the game
	*/	
	self.newGame = function() {
		model.resetGame();
		view.buildBoard();
		self.isLive = true;
		if (!model.getHumanTurn()) {
			self.computerTurn();
		}
	};
	
	/* function elemToCoords
	 *
	 * Take an array index and turns it into grid coords (x, y)
	*/	 
	function elemToCoords(elem) {
		var x = elem % 3;
		var y = Math.floor(elem / 3);
		
		return [x, y];
	}
	
	/* function coordsToElem
	 *
	 * Takes grid coords (x, y) and turns into an array index
	*/
	function coordsToElem(coords) {
		return coords[1] * 3 + coords[0];
	}
	
	/* function clickedTile
	 *
	 * For the player's turn, checks for valid input, which leads to updating the grid
	*/
	self.clickedTile = function(elem) {
		if (!self.isLive) {
			return;
		}
		
		var coords = elemToCoords(elem);

		if (!model.isTileEmpty(coords)) {
			return;
		}

		if (model.getTurn() <= 3) {
			model.saveHumanPlays(coords);
		}
		
		self.updateTile(coords, elem);
	};
	
	/* function updateTile
	 *
	 * Updates both the model and the view on a successful play.
	 * Also checks for game over or next turn
	*/
	self.updateTile = function(coords, elem) {
		model.updateTile(coords);
		view.renderPiece(model.getCurrentPiece(), elem);
		
		if (self.isGameOver(coords)) {
			self.gameOverFeedback();
		}
		else {
			self.nextTurn();
		}
	};
	
	/* function isGameOver
	 *
	 * Checks for victory/tie conditions
	*/
	self.isGameOver = function(coords) {
		if (model.getTurn() >= 5) {
			return model.isVictory(coords);			
		}
		return false;
	};
	
	/* function gameOverFeedback
	 *
	 * Sets up the winning (or tying) tiles to be highlighted in order
	 * to alert player that game is over.
	 * Starts a new game after a slight pause.
	*/
	self.gameOverFeedback = function() {
		var victoryCoords = model.getVictoryTiles();
		var victoryElems = [];

		if (victoryCoords.length === 3) {	//win
			for (var i = 0; i < 3; i++) {
				victoryElems.push(coordsToElem(victoryCoords[i]));
			}
		}
		else {
			for (var i = 0; i < 9; i++) {	//tie
				victoryElems.push(i);
			}
		}

		view.highlightTiles(victoryElems);
		self.isLive = false;
		setTimeout(self.newGame, 600);
	}
	
	/* function nextTurn
	 *
	 * Moves to the next turn (and handles the computer's turn)
	*/
	self.nextTurn = function() {
		model.switchTurn();
		if (!model.getHumanTurn()) {
			self.computerTurn();
		}
	};
	
	/* function computerTurn
	 *
	 * The computer AI selects a tile, which is then told to update
	*/
	self.computerTurn = function() {
		var tile = model.aiTileSelection();
		var id = coordsToElem(tile);
			
		self.updateTile(tile, id);
	};
}