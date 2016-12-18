var input = "10001001100000001";

function getDragon(input, length) {
    while (input.length < length) {
        input += '0' + input.split('').reverse().map(i => i = 1 - i).join('');
    }
    
    return input.substr(0, length);
}

function checksum(string) {
    var temp = '';
    
    for(var i = 0; i < string.length; i += 2) {
        temp += (string[i] == string[i + 1]) ? '1' : '0';
    }
    
    return (temp.length % 2 === 1) ? temp : checksum(temp);
}

console.log('Part one : ', checksum(getDragon(input, 272)))
console.log('Part two : ', checksum(getDragon(input, 35651584)))