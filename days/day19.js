var     _ = require('lodash');

const   elfes_count = 3001330;
var     elves       = [];

for(var i = 1; i <= elfes_count; i++) {
    elves.push({'elf' : i, 'gifts' : 1});
}

while (elves.length > 1) {
    elves.forEach(function(elfe, index){
        var steal_index = (index === elves.length - 1) ? 0 : index + 1;

        elfe.gifts += elves[steal_index].gifts;

        delete elves[steal_index];
    });

    elves =     _.compact(elves);
}

console.log(elves);

var elves       = [];

for(var i = 1; i <= elfes_count; i++) {
    elves.push({'elf' : i, 'gifts' : 1});
}

var position = 0;

while (elves.length > 1) {
    var steal_index = (Math.floor(elves.length / 2) + position) % elves.length;

    elves[position].gifts += elves[steal_index].gifts;

    delete elves[steal_index];

    elves =     _.compact(elves);
    
    if (position === elves.length) {
        position = 0;
    } else {
        position++;
    }
    
    if (elves.length%1000 === 0) {
        console.log(elves.length);
    }
}

console.log(elves);