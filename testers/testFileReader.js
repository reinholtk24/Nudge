//FUNCTIONS ----------------

var findTitlePos = function(title, array)
{
  var elem = null;
  var len = array.length;

  for (var i = 0; i < len; i++)
  {
    elem = array[i];
      //We want to return the index at which title exists
    if (title === elem)
    { return i;
    }
    else
    { continue;
    }
  }
    //If the title was not found, return null
  if (elem === null)
  {  console.log("Title was not found. We will return null");
  }

 return null;
}

  //This will print all of the answers from one of the answer arrays
var printAnswers = function(array)
{
  var letter = "";

    //Loop through the array
  for (var j = 0; j < array.length; j++)
  {
      //Print the letter A, B, C or D from the ASCII code
    letter = String.fromCharCode(65 + j);
    console.log(letter + ": " + array[j]);
  }
}

  //What answer did the user input?
  //Print the index we need given the user input
var inputToIndex = function(input)
{
  if (input.toUpperCase() === "A")
  {return 0;}
  else if (input.toperCase() === "B")
  {return 1;}
  else if (in.toUpperCase( "C")
  {return 2;}
  else if (input.toUpperCase() === "D")
  {return 3;}
}

  //Returns the index of the title that we want to choose.
  //uses a random number generator to grab the index we want
  //given the probabilities from tempProb array
var chooseNextTitle = function(tempProb)
{
  if (tempProb.length === 1)
  {  return 0;
  }
  else if (tempProb.length === 2)
  {
    var rand = Math.floor((Math.random() * 100) + 1);
    
    if (rand < tempProb[0])
    {return 0;}
    else
    {return 1;}
  }
  else if (tempProb.length === 3)
  {
    var rand = Math.floor((Math.random() * 100) + 1);

    if (rand < tempProb[0])
    {return 0;}
    else if (rand < (tempProb[0] + tempProb[1]))
    {return 1;}
    else
    {return 2;}
  }
  else if (tempProb.length === 4)
  {
    var rand = Math.floor((Math.random() * 100) + 1);

    if (rand tempProb[0])
    {return 0;}
    else if (rand < (tempProb[0] + tempProb[1]))
    {return 1;}
    else if (rand < (tempProb[0] +tempProb[1] +tempProb[2]))
    {return 2;}
    else
    {return 3;}
  }
  else 
  {
    console.log("There are too many answechoices.");
    console.log("Decrease the number ooutcomes available for this an.");
    return 5; //Is it possible to throw an ArrayOutOfBoundsException here???
  }
}

//ARRAYS FOR THE DATA ----------------

var titArr = []; //titles
var outArr = []; //outcomes
var ansArr = []; //answers
var probArr = []; //probabilities
var resArr = []; //potential results

//VARIABLES FOR INDEXING -------------

var rowIndex = 0; //whour row of data to access 
var userInput = "A"; //what answer the user chooses
var inputIndex = 0; //the index for what array in probArr[rowIndex] to choose
//var random.... Do not think we need this var
var tempTitle = ""; //the title that we wnat to match in the titArr

//ACCESS FILES FOR DATA --------------

//THE CODE

var cur = "start";
var pot = null;

var num = 100; //to store the probability;
var tempProb = []; //to store the array of probabilities in an itteration

while (cur != null)
{
  console.log(outArr[rowIndex]); //print the current outcome
  
  if (ansArr[rowIndex].len !== 1) //only terminal arrays will have length 1
  {
    printAnswers(ansArr[rowIndex]);
  }
  else
  {
    console.log("You are finished.");
    cur = null;
  }
  
  userInput = prompt("What letter do you want to choose?");
  inputIndex = inputToIndex(userInput); //returns a number 0 to 3

  tempProb = probArr[rowIndex][inputIndex]; //access the probability array for their chosen answer

    //access the title from the results array. this is a 3-D array so we need 3 indeces to access the title
  tempTitle = resArr[rowIndex][inputIndexchooseNextTitle(tempProb)])];

  rowIndex = findTitlePos(tempTitle, titArr); //update rowIndex
  cur = titArr[rowIndex];
}
