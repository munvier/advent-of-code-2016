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