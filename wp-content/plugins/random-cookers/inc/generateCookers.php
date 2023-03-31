<?php

function generatePet()
{
  $names = array("Abby", "Ace", "Allie", "Angel", "Annie", "Apollo", "Archie", "Athena", "Baby", "Bailey", "Bandit", "Baxter", "Bear", "Beau", "Bella", "Belle", "Benji", "Benny", "Bentley", "Blue", "Bo", "Bob", "Bonnie", "Boo", "Boomer", "Boots", "Brady", "Brandy", "Brody", "Bruno", "Brutus", "Bubba", "Buddy", "Buster", "Cali", "Callie", "Casey", "Cash", "Casper", "Champ", "Chance", "Charlie", "Chase", "Chester", "Chico", "Chloe", "Cleo", "Coco", "Cocoa", "Cody", "Cookie", "Cooper", "Copper", "Cuddles", "Daisy", "Dakota", "Dexter", "Diesel", "Dixie", "Duke", "Dusty", "Ella", "Ellie", "Elvis", "Emma", "Felix", "Finn", "Fluffy", "Frankie", "Garfield", "George", "Gigi", "Ginger", "Gizmo", "Grace", "Gracie", "Gus", "Hank", "Hannah", "Harley", "Hazel", "Heidi", "Henry", "Holly", "Honey", "Hunter", "Izzy", "Jack", "Jackson", "Jake", "Jasmine", "Jasper", "Jax", "Joey", "Josie", "Katie", "Kiki", "Kobe", "Kona", "Lacey", "Lady", "Layla", "Leo", "Lexi", "Lexie", "Lilly", "Lily", "Loki", "Lola", "Louie", "Lucky", "Lucy", "Luke", "Lulu", "Luna", "Mac", "Macy", "Maddie", "Madison", "Maggie", "Marley", "Max", "Maya", "Mia", "Mickey", "Midnight", "Millie", "Milo", "Mimi", "Minnie", "Miss kitty", "Missy", "Misty", "Mittens", "Mocha", "Molly", "Moose", "Muffin", "Murphy", "Nala", "Nikki", "Olive", "Oliver", "Ollie", "Oreo", "Oscar", "Otis", "Patches", "Peanut", "Pebbles", "Penny", "Pepper", "Phoebe", "Piper", "Precious", "Prince", "Princess", "Pumpkin", "Rascal", "Rex", "Riley", "Rocco", "Rocky", "Romeo", "Roscoe", "Rosie", "Roxie", "Roxy", "Ruby", "Rudy", "Rufus", "Rusty", "Sadie", "Salem", "Sally", "Sam", "Samantha", "Sammy", "Samson", "Sandy", "Sasha", "Sassy", "Scooter", "Scout", "Shadow", "Sheba", "Shelby", "Sierra", "Simba", "Simon", "Smokey", "Snickers", "Snowball", "Snuggles", "Socks", "Sophie", "Sparky", "Spike", "Spooky", "Stella", "Sugar", "Sydney", "Tank", "Teddy", "Thor", "Tiger", "Tigger", "Tinkerbell", "Toby", "Trixie", "Trouble", "Tucker", "Tyson", "Walter", "Willow", "Winnie", "Winston", "Zeus", "Ziggy", "Zoe", "Zoey");
  $suffix = array("Senior", "Junior", "The Third", "The Fourth", "The Fifth", "The Sixth", "The Seventh", "The Eighth", "The Ninth");
  $foods = array("Apple", "Apricot", "Asparagus", "Avocado", "Banana", "Blackberry", "Blueberry", "Boysenberry", "Broccoli", "Cabbage", "Cantaloupe", "Carrot", "Celery", "Cherry", "Cilantro", "Clementine", "Coconut", "Corn", "Cranberry", "Cucumber", "Dragonfruit", "Fig", "Garlic", "Goji berry", "Gooseberry", "Grape", "Grapefruit", "Guava", "Honeyberry", "Honeydew", "Huckleberry", "Jackfruit", "Kiwifruit", "Kumquat", "Lemon", "Lime", "Loquat", "Mandarine", "Mango", "Marionberry", "Mulberry", "Nance", "Nectarine", "Olive", "Onion", "Orange", "Papaya", "Passionfruit", "Peach", "Pear", "Persimmon", "Pineapple", "Plantain", "Plum", "Plumcot", "Pomegranate", "Prune", "Raisin", "Raspberry", "Strawberry", "Tamarind", "Tangerine", "Tomato", "Turnip", "Watermelon", "Yam", "Zucchini");
  $hobbies = array("walking", "running", "eating", "sleeping", "playing fetch", "sunbathing", "scratching furniture", "destroying stuff", "chasing stuff");

  $combined_name = $names[array_rand($names, 1)] . " " . $suffix[array_rand($suffix, 1)];

  return array(
    'birthyear' => rand(1950, 1999),
    'cookweight' => rand(60, 120),
    'cookname' => trim($combined_name),
    'favfood' => $foods[array_rand($foods, 1)],
    'favhobby' => $hobbies[array_rand($hobbies, 1)]
  );
}
