const searchBox = document.querySelector('.searchBox');
const searchBtn = document.querySelector('.sreachbtn');
const recipeContainer = document.querySelector('.recipe-container');
const recipeDetailsContent = document.querySelector('.recipe-details-content');
const recipeCloseBtn = document.querySelector('.recipe-colse-btn');
let notFound=false;

const myapiRecipe = async (query) => {
  recipeContainer.innerHTML = "<h1>Featching Recipes....</h2>";
  try {
    const data = await fetch(`https://aviscodeverse.tech/api/api.php/?search=${query}`);
    const response = await data.json();
    //console.log(responce.meals[0]);
    recipeContainer.innerHTML = "";
    response.recipe.forEach(meal => {
      const recipeDiv = document.createElement('div');
      recipeDiv.classList.add('recipe');
      recipeDiv.innerHTML = `
    <img src="${meal.recipeImage}">
    <h3>Recipe Name : ${meal.recipeName}</h3>
    <p><span>${meal.location} </span>Dish<p/>
    <p>Catagory is :<span>${meal.category}</span><p/>
    <p>Made By :<span>${meal.username}</span><p/>

    `

      const button = document.createElement('button');
      button.textContent = "view Recipe";
      recipeContainer.appendChild(recipeDiv);
      recipeDiv.appendChild(button);
      //adding addEventListener to recipe button
      button.addEventListener('click', () => {
        openMyRecipePopup(meal);
      });
    });
  } catch (error) {
    // recipeContainer.innerHTML = "<h1>Recipe Not Found</h1>";
    notFound=true;
  }
}
//Function To Get Recipe 
const fetchRecipes = async (query) => {
  recipeContainer.innerHTML = "<h1>Featching Recipes....</h2>";
  try {
    const data = await fetch(`https://www.themealdb.com/api/json/v1/1/search.php?s=${query}`);
    const response = await data.json();
    //console.log(responce.meals[0]);
    // recipeContainer.innerHTML = "";
    response.meals.forEach(meal => {
      const recipeDiv = document.createElement('div');
      recipeDiv.classList.add('recipe');
      recipeDiv.innerHTML = `
    <img src="${meal.strMealThumb}">
    <h3>Recipe Name : ${meal.strMeal}</h3>
    <p><span>${meal.strArea} </span>Dish<p/>
    <p>Catagory is :<span>${meal.strCategory}</span><p/>
    <p>Made By :<span>Bot</span><p/>
    `

      const button = document.createElement('button');
      button.textContent = "view Recipe";
      recipeContainer.appendChild(recipeDiv);
      recipeDiv.appendChild(button);
      //adding addEventListener to recipe button
      button.addEventListener('click', () => {
        openRecipePopup(meal);
      });
    });
  } catch (error) {
      if(notFound){
    recipeContainer.innerHTML = "<h1>Recipe Not Found</h1>";
      }
    // myapiRecipe(query);
  }
}
//function fatch ingradiends and mesurments
const fatchIngredients = (meal) => {
  let ingredentsList = "";
  for (let i = 1; i <= 20; i++) {
    const ingredent = meal[`strIngredient${i}`];
    if (ingredent) {
      const measure = meal[`strMeasure${i}`];
      ingredentsList += `<li>${measure} ${ingredent}</li>`
    }
    else {
      break;
    }
  }
  return ingredentsList;
}

const openRecipePopup = (meal) => {
  recipeDetailsContent.innerHTML = `
    <h2 class="recipeName"> ${meal.strMeal}</h2>
    <h3>Ingredients</h3>
    <Ul class= "ingredientsList">${fatchIngredients(meal)}<Ul/>
    <div class ="recipeInstructions">
        <h3>Instructions:</h3>
        <p >${meal.strInstructions}</p>
        <a href="${meal.strYoutube}" target="_blank">Youtube</a>
    </div>
    `
   console.log(meal.strInstructions)
  recipeDetailsContent.parentElement.style.display = "block";
}
recipeCloseBtn.addEventListener('click', () => {
  recipeDetailsContent.parentElement.style.display = "none";
});

const openMyRecipePopup = (meal) => {
  let ingradientTextWithCarriageReturns = meal.recipeIngredients;
  let htmlFormattedTextingradients = ingradientTextWithCarriageReturns.replace(/\r/g, '<br>');
  let instructionTextWithCarriageReturns = meal.recipeInstruction;
  let htmlFormattedTextInstruction = instructionTextWithCarriageReturns.replace(/\r/g, '<br>');
  recipeDetailsContent.innerHTML = `
    <h2 class="recipeName"> ${meal.recipeName}</h2>
    <h3>Ingredients</h3>
    <Ul class= "ingredientsList">${htmlFormattedTextingradients}<Ul/>
    <div class ="recipeInstructions">
        <h3>Instructions:</h3>
        <p >${htmlFormattedTextInstruction}</p>
        <a href="${meal.youtubeLink}" target="_blank">Youtube</a>
    </div>
    `
   console.log(meal.strInstructions)
  recipeDetailsContent.parentElement.style.display = "block";
}
recipeCloseBtn.addEventListener('click', () => {
  recipeDetailsContent.parentElement.style.display = "none";
});

searchBtn.addEventListener('click', (e) => {
  e.preventDefault(); // avioding the page refresh
  //console.log("cliked")
  const searchInput = searchBox.value.trim();
  myapiRecipe(searchInput);
  fetchRecipes(searchInput);
});
