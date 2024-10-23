function toggleMainMenu(menuId) {
    const submenus = document.querySelectorAll('.submenu');
    submenus.forEach(menu => {
        if (menu.id === menuId) {
            menu.classList.toggle('open');
        } else {
            menu.classList.remove('open');
        }
    });
}

function toggleVisibility(containerId) {
    const container = document.getElementById(containerId);
    if (container) {
        const isVisible = container.classList.contains('hidden');

       
        const allContainers = document.querySelectorAll('.action-container, .container');
        allContainers.forEach(cont => {
            if (cont.id !== containerId && cont.id !== 'admin_Panel') {
                cont.classList.add('hidden');
            }
        });

        
        container.classList.toggle('hidden');

        
        const submenuLinks = container.querySelectorAll('.submenu-link');
        submenuLinks.forEach(link => {
            link.addEventListener('mouseenter', () => {
                if (!isVisible) {
                    container.classList.add('open');
                }
            });
            link.addEventListener('mouseleave', () => {
                if (!isVisible) {
                    container.classList.remove('open');
                }
            });
            link.addEventListener('click', (event) => {
                event.preventDefault();
            });
        });
    }
}

let selectedUserId = null;
async function selectUser(userId) {
    selectedUserId = userId;

    await fetch(`/auth/user/${userId}`)
        .then(response => response.json())
        .then(user => {
            sessionStorage.setItem('selectedUser', JSON.stringify(user));
        })
        .catch(error => {
            console.error('Error fetching user data:', error);
        });
}

let selectedProductId = null;
async function selectProduct(productId) {
    selectedProductId = productId;

    await fetch(`/auth/product/${productId}`)
        .then(response => response.json())
        .then(product => {
            sessionStorage.setItem('selectedProduct', JSON.stringify(product));
            populateProductForms(product);
        })
        .catch(error => {
            console.error('Error fetching product data:', error);
        });
}

let selectedMealId = null;
async function selectMeal(mealId) {
    selectedMealId = mealId;

    await fetch(`/auth/meal/${mealId}`)
        .then(response => response.json())
        .then(meal => {
            sessionStorage.setItem('selectedMeal', JSON.stringify(meal));
            populateMealForms(meal);
        })
        .catch(error => {
            console.error('Error fetching meal data:', error);
        });
}
let selectedExerciseId = null;
async function selectExercise(exerciseId) {
    selectedExerciseId = exerciseId;

    await fetch(`/auth/exercise/${exerciseId}`)
        .then(response => response.json())
        .then(exercise => {
            sessionStorage.setItem('selectedExercise', JSON.stringify(exercise));
            populateExerciseForms(exercise);
        })
        .catch(error => {
            console.error('Error fetching exercise data:', error);
        });
}
let selectedCoachId = null;
async function selectCoach(coachId) {
    selectedCoachId = coachId;

    await fetch(`/auth/coach/${coachId}`)
        .then(response => response.json())
        .then(coach => {
            sessionStorage.setItem('selectedCoach', JSON.stringify(coach));
            populateCoachForms(coach);
        })
        .catch(error => {
            console.error('Error fetching coach data:', error);
        });
}


// Product
function populateProductForms(product) {
    document.getElementById('editProductName').value = product.productname;
    document.getElementById('newProductName').value = product.productname;
    document.getElementById('editproductId').value = product.id;
    document.getElementById('editproductPrice').value = product.price;
    document.getElementById('editproductImage').src = product.img || 'default-image.png';

    document.getElementById('removeProductName').value = product.productname;
    document.getElementById('removeProductId').value = product.id;
}


// Meal
function populateMealForms(meal) {
    document.getElementById('editMealName').value = meal.mealname;
    document.getElementById('newMealName').value = meal.mealname;
    document.getElementById('newMealDescription').value = meal.mealdescription;

    document.getElementById('removeMealName').value = meal.mealname;

   
    const ingredientsContainer = document.getElementById('newIngredientsContainer');
    ingredientsContainer.innerHTML = '';

    // Populate the ingredients
    meal.ingredients.forEach((ingredient, index) => {
        const ingredientGroup = document.createElement('div');
        ingredientGroup.className = 'ingredient-group';
        ingredientGroup.innerHTML = `
            <input type="text" name="newIngredients[${index}][name]" placeholder="Ingredient Name" value="${ingredient.name}" required>
            <input type="text" name="newIngredients[${index}][quantity]" placeholder="Quantity" value="${ingredient.quantity}" required>
            <button type="button" class="remove-button" onclick="removeIngredient(this)">-</button>
        `;
        ingredientsContainer.appendChild(ingredientGroup);
    });
}

// Exercise
function populateExerciseForms(exercise) {
    document.getElementById('editExerciseName').value = exercise.exercisename;
    document.getElementById('newExerciseName').value = exercise.exercisename;
    document.getElementById('exercisedescription').value = exercise.exercisedescription;
    document.getElementById('exerciseimage').value = exercise.exerciseimage;

    document.getElementById('removeExerciseName').value = exercise.exercisename;
}


// Coach
function populateCoachForms(coach) {
    document.getElementById('editCoachName').value = coach.coachname;
    document.getElementById('newCoachName').value = coach.coachname;
    document.getElementById('newCoachDescription').value = coach.coachdescription;
    document.getElementById('editCoachImage').src = coach.coachimage || 'default-image.png';

    document.getElementById('removeCoachName').value = coach.coachname;
}










// user
function viewUser() {
    const user = JSON.parse(sessionStorage.getItem('selectedUser'));

    document.getElementById('viewUsername').innerText = user.username;
    document.getElementById('viewFullName').innerText = user.fullname;
    document.getElementById('viewEmail').innerText = user.useremail;
    document.getElementById('viewPhone').innerText = user.userphone;
    document.getElementById('viewRole').innerText = user.role;
    document.getElementById('viewGender').innerText = user.gender;
    document.getElementById('viewAge').innerText = user.age;
    document.getElementById('viewAddress').innerText = user.address;
    document.getElementById('viewSubscription').innerText = user.Subscription;
    document.getElementById('viewImage').src = user.img || 'default-image.png';

    document.getElementById('ViewUserContainer').classList.remove('hidden');
}

function editUser() {
    const user = JSON.parse(sessionStorage.getItem('selectedUser'));

    document.getElementById('editUsersName').value = user.username;
    document.getElementById('newUsersFullName').value = user.fullname;
    document.getElementById('UsersPassword').value = user.password; // Do not pre-fill passwords
    document.getElementById('userphone').value = user.userphone;
    document.getElementById('edituseremail').value = user.useremail;
    document.getElementById('editUsersrole').value = user.role;
    document.getElementById('edit-gender').value = user.gender;
    document.getElementById('editUsersage').value = user.age;
    document.getElementById('editUsersaddress').value = user.address;
    console.log(user.Subscription)
    document.getElementById('edit-subscribtion').value = user.Subscription;

    document.getElementById('editUserContainer').classList.remove('hidden');
}

function removeUser() {
    const user = JSON.parse(sessionStorage.getItem('selectedUser'));

    document.getElementById('removeUsersName').value = user.username;
    document.getElementById('removeUsersId').value = user._id;

    document.getElementById('removeUserContainer').classList.remove('hidden');
}

document.getElementById('editUsersForm').addEventListener('submit', async function (event) {
    event.preventDefault();
    const formData = new FormData(this);

    await fetch(`/auth/user/${selectedUserId}`, {
        method: 'PUT',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                alert(data.message);
                toggleVisibility('editUserContainer');
            }
        })
        .catch(error => {
            console.error('Error updating user:', error);
            alert('An error occurred while updating the user.');
        });
});

document.getElementById('removeUsersForm').addEventListener('submit', async function (event) {
    event.preventDefault();

    await fetch(`/auth/user/${selectedUserId}`, {
        method: 'DELETE'
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                alert(data.message);
                toggleVisibility('removeUserContainer');
            }
        })
        .catch(error => {
            console.error('Error deleting user:', error);
        });
});



const notyf = new Notyf({
    position: {
        x: 'right', // 'left' or 'right' or 'center'
        y: 'top', // 'top' or 'bottom'
    },
});

// Edit Exercise
async function editExercise() {
    const editExerciseName = document.getElementById('editExerciseName').value;
    const newExerciseName = document.getElementById('newExerciseName').value;
    const exercisedescription = document.getElementById('exercisedescription').value;
    const exerciseimage = document.getElementById('exerciseimage').value;
    const Exercisetype = document.getElementById('Exercisetype').value;

    const exerciseData = {
        editExerciseName,
        newExerciseName,
        exercisedescription,
        exerciseimage,
        Exercisetype
    };

    await fetch('/auth/editexercise', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(exerciseData)
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                notyf.error(data.error);
            } else {
                notyf.success(data.message);
                toggleVisibility('editExerciseContainer');
            }
        })
        .catch(error => {
            console.error('Error updating exercise:', error);
            notyf.error('An error occurred while updating the exercise.');
        });
}

// Remove Exercise
async function removeExercise() {
    const exerciseName = document.getElementById('removeExerciseName').value;

    await fetch('/auth/removeexercise', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ removeExerciseName: exerciseName })
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                notyf.error(data.error);
            } else {
                notyf.success(data.message);
                toggleVisibility('removeExerciseContainer');
            }
        })
        .catch(error => {
            console.error('Error removing exercise:', error);
            notyf.error('An error occurred while removing the exercise.');
        });
}

// Edit Meal
async function editMeal() {
    const editMealName = document.getElementById('editMealName').value;
    const newMealName = document.getElementById('newMealName').value;
    const newMealdescription = document.getElementById('newMealDescription').value;
    const newIngredients = [];
    document.querySelectorAll('#newIngredientsContainer .ingredient-group').forEach((group, index) => {
        const name = group.querySelector(`input[name="newIngredients[${index}][name]"]`).value;
        const quantity = group.querySelector(`input[name="newIngredients[${index}][quantity]"]`).value;
        newIngredients.push({ name, quantity });
    });

    const mealData = {
        editMealName,
        newMealName,
        newMealdescription,
        newIngredients
    };

    await fetch('/auth/editmeal', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(mealData)
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                notyf.error(data.error);
            } else {
                notyf.success(data.message);
                toggleVisibility('editMealContainer');
            }
        })
        .catch(error => {
            console.error('Error updating meal:', error);
            notyf.error('An error occurred while updating the meal.');
        });
}

// Remove Meal
async function removeMeal() {
    const mealName = document.getElementById('removeMealName').value;

    await fetch('/auth/removemeal', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ removeMealName: mealName })
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                notyf.error(data.error);
            } else {
                notyf.success(data.message);
                toggleVisibility('removeMealContainer');
            }
        })
        .catch(error => {
            console.error('Error removing meal:', error);
            notyf.error('An error occurred while removing the meal.');
        });
}

// Edit Product
async function editProduct() {
    const editProductName = document.getElementById('editProductName').value;
    const newProductName = document.getElementById('newProductName').value;
    const productId = document.getElementById('productId').value;
    const productPrice = document.getElementById('productPrice').value;

    const productData = {
        editProductName,
        newProductName,
        productId,
        productPrice
    };

    await fetch('/auth/editProduct', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(productData)
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                notyf.error(data.error);
            } else {
                notyf.success(data.message);
                toggleVisibility('editProductsContainer');
            }
        })
        .catch(error => {
            console.error('Error updating product:', error);
            notyf.error('An error occurred while updating the product.');
        });
}

// Remove Product
async function removeProduct() {
    const productName = document.getElementById('removeProductName').value;
    const productId = document.getElementById('removeProductId').value;

    try {
        const response = await fetch('/auth/removeProduct', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ removeProductName: productName, removeProductId: productId })
        });

        const data = await response.json();
        if (data.error) {
            notyf.error(data.error);
        } else {
            notyf.success(data.message);
            toggleVisibility('removeProductsContainer');
        }
    } catch (error) {
        console.error('Error removing product:', error);
        notyf.error('An error occurred while removing the product.');
    }
}


// Edit Coach
async function editCoach() {
    const editCoachName = document.getElementById('editCoachName').value;
    const newCoachName = document.getElementById('newCoachName').value;
    const coachDescription = document.getElementById('newCoachDescription').value;

    const coachData = {
        editCoachName,
        newCoachName,
        coachDescription
    };

    try {
        const response = await fetch('/auth/editcoaches', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(coachData)
        });

        const data = await response.json();
        if (data.error) {
            notyf.error(data.error);
        } else {
            notyf.success(data.message);
            toggleVisibility('editCoachesContainer');
        }
    } catch (error) {
        console.error('Error updating coach:', error);
        notyf.error('An error occurred while updating the coach.');
    }
}


// Remove Coach
async function removeCoach() {
    const coachName = document.getElementById('removeCoachName').value;

    try {
        const response = await fetch('/auth/removecoach', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ removeCoachName: coachName })
        });

        const data = await response.json();
        if (data.error) {
            notyf.error(data.error);
        } else {
            notyf.success(data.message);
            toggleVisibility('removeCoachesContainer');
        }
    } catch (error) {
        console.error('Error removing coach:', error);
        notyf.error('An error occurred while removing the coach.');
    }
}


// Form Submission Event Listeners
document.getElementById('editExerciseForm').addEventListener('submit', function (event) {
    event.preventDefault();
    editExercise();
});

document.getElementById('removeExerciseForm').addEventListener('submit', function (event) {
    event.preventDefault();
    removeExercise();
});

document.getElementById('editMealForm').addEventListener('submit', function (event) {
    event.preventDefault();
    editMeal();
});

document.getElementById('removeMealForm').addEventListener('submit', function (event) {
    event.preventDefault();
    removeMeal();
});

document.getElementById('editProductForm').addEventListener('submit', function (event) {
    event.preventDefault();
    editProduct();
});

document.getElementById('removeProductForm').addEventListener('submit', function (event) {
    event.preventDefault();
    removeProduct();
});

document.getElementById('editCoachForm').addEventListener('submit', function (event) {
    event.preventDefault();
    editCoach();
});

document.getElementById('removeCoachForm').addEventListener('submit', function (event) {
    event.preventDefault();
    removeCoach();
});


document.getElementById('addProductForm').addEventListener('submit', async function (event) {
    event.preventDefault();
    const formData = new FormData(this);

    await fetch('/auth/addProduct', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                notyf.error(data.error);
            } else {
                notyf.success('Product added successfully');
                document.getElementById('addProductForm').reset();
            }
        })
        .catch(error => {
            console.error('Error adding product:', error);
            notyf.error('An error occurred while adding the product.');
        });
});
document.getElementById('addCoachForm').addEventListener('submit', async function (event) {
    event.preventDefault();
    const formData = new FormData(this);

    await fetch('/auth/addcoaches', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                notyf.error(data.error);
            } else {
                notyf.success('Coach added successfully');
                document.getElementById('addCoachForm').reset();
            }
        })
        .catch(error => {
            console.error('Error adding coach:', error);
            notyf.error('An error occurred while adding the coach.');
        });
});


document.getElementById('addMealForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);

    try {
        const response = await fetch('/auth/addmeal', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json();
        if (response.ok) {
            notyf.success(result.message);  // Show success notification
        } else {
            notyf.error(result.error);  // Show error notification
        }
    } catch (error) {
        console.error('Error:', error);
        notyf.error('An error occurred while adding the meal.');  // Show error notification
    }
});

document.getElementById('addExerciseForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);

    try {
        const response = await fetch('/auth/addexercise', {
            method: 'POST',
            body: formData,
        });

        const result = await response.json();
        if (response.ok) {
            notyf.success(result.message);  // Show success notification
        } else {
            notyf.error(result.error);  // Show error notification
        }
    } catch (error) {
        console.error('Error:', error);
        notyf.error('An error occurred while adding the exercise.');  // Show error notification
    }
});























// Product Form Validation
function validateForm() {
    const productNameInput = document.getElementById('productName');
    const productPriceInput = document.getElementById('productPrice');
    const productName = productNameInput.value.trim();
    const productPrice = productPriceInput.value.trim();
    let isValid = true;

    document.getElementById('productNameError').textContent = '';
    document.getElementById('productPriceError').textContent = '';

    if (productName === '') {
        document.getElementById('productNameError').textContent = 'Product name is required';
        isValid = false;
    } else if (!/^[a-zA-Z]+$/.test(productName)) {
        document.getElementById('productNameError').textContent = 'Product name must contain only letters';
        isValid = false;
    }

    if (productPrice === '') {
        document.getElementById('productPriceError').textContent = 'Product price is required';
        isValid = false;
    } else if (isNaN(productPrice) || parseFloat(productPrice) <= 0) {
        document.getElementById('productPriceError').textContent = 'Product price must be a valid positive number';
        isValid = false;
    }

    if (isValid) {
        productNameInput.value = '';
        productPriceInput.value = '';
        document.getElementById('successMessage').textContent = 'Product Added';
    }

    return isValid;
}

// Coach Form Validation
function validateCoachForm() {
    const coachNameInput = document.getElementById('coachName');
    const coachSpecialtyInput = document.getElementById('coachSpecialty');
    const coachName = coachNameInput.value.trim();
    const coachSpecialty = coachSpecialtyInput.value.trim();
    let isValid = true;

    document.getElementById('coachNameError').textContent = '';
    document.getElementById('coachSpecialtyError').textContent = '';

    if (coachName === '') {
        document.getElementById('coachNameError').textContent = 'Coach name is required';
        isValid = false;
    } else if (!/^[a-zA-Z\s]+$/.test(coachName)) {
        document.getElementById('coachNameError').textContent = 'Coach name must contain only letters';
        isValid = false;
    }

    if (coachSpecialty === '') {
        document.getElementById('coachSpecialtyError').textContent = 'Coach specialty is required';
        isValid = false;
    } else if (!/^[a-zA-Z\s]+$/.test(coachSpecialty)) {
        document.getElementById('coachSpecialtyError').textContent = 'Coach specialty must contain only letters';
        isValid = false;
    }

    if (isValid) {
        coachNameInput.value = '';
        coachSpecialtyInput.value = '';
        document.getElementById('coachSuccessMessage').textContent = 'Coach Added';
    }

    return isValid;
}

// Edit Coach Form Validation
function validateEditCoachForm() {
    const editCoachNameInput = document.getElementById('editCoachName');
    const editCoachSpecialtyInput = document.getElementId('editCoachSpecialty');
    const newCoachNameInput = document.getElementId('newCoachName');
    const newCoachSpecialtyInput = document.getElementId('newCoachSpecialty');
    const editCoachName = editCoachNameInput.value.trim();
    const editCoachSpecialty = editCoachSpecialtyInput.value.trim();
    const newCoachName = newCoachNameInput.value.trim();
    const newCoachSpecialty = newCoachSpecialtyInput.value.trim();
    let isValid = true;

    document.getElementById('editCoachNameError').textContent = '';
    document.getElementById('editCoachSpecialtyError').textContent = '';
    document.getElementById('newCoachNameError').textContent = '';
    document.getElementById('newCoachSpecialtyError').textContent = '';
    document.getElementById('editCoachSuccessMessage').textContent = '';

    if (editCoachName === '') {
        document.getElementById('editCoachNameError').textContent = 'Coach name is required';
        isValid = false;
    } else if (!/^[a-zA-Z\s]+$/.test(editCoachName)) {
        document.getElementById('editCoachNameError').textContent = 'Coach name must contain only letters';
        isValid = false;
    }

    if (editCoachSpecialty === '') {
        document.getElementById('editCoachSpecialtyError').textContent = 'Coach specialty is required';
        isValid = false;
    } else if (!/^[a-zA-Z\s]+$/.test(editCoachSpecialty)) {
        document.getElementById('editCoachSpecialtyError').textContent = 'Coach specialty must contain only letters';
        isValid = false;
    }

    if (newCoachName === '') {
        document.getElementById('newCoachNameError').textContent = 'New name is required';
        isValid = false;
    } else if (!/^[a-zA-Z\s]+$/.test(newCoachName)) {
        document.getElementById('newCoachNameError').textContent = 'New name must contain only letters';
        isValid = false;
    } else if (newCoachName.toLowerCase() === editCoachName.toLowerCase()) {
        document.getElementById('newCoachNameError').textContent = 'New name must be different from the coach name';
        isValid = false;
    }

    if (newCoachSpecialty === '') {
        document.getElementById('newCoachSpecialtyError').textContent = 'New specialty is required';
        isValid = false;
    } else if (!/^[a-zA-Z\s]+$/.test(newCoachSpecialty)) {
        document.getElementById('newCoachSpecialtyError').textContent = 'New specialty must contain only letters';
        isValid = false;
    } else if (newCoachSpecialty.toLowerCase() === editCoachSpecialty.toLowerCase()) {
        document.getElementById('newCoachSpecialtyError').textContent = 'New specialty must be different from the current one';
        isValid = false;
    }

    if (isValid) {
        editCoachNameInput.value = '';
        editCoachSpecialtyInput.value = '';
        newCoachNameInput.value = '';
        newCoachSpecialtyInput.value = '';
        document.getElementById('editCoachSuccessMessage').textContent = 'Edited Successfully';
    }

    return isValid;
}

// Remove Coach Form Validation
async function validateremoveCoachForm() {
    const coachNameInput = document.getElementById('removeCoachName');
    const coachName = coachNameInput.value.trim();
    let isValid = true;

    document.getElementById('removeCoachNameError').textContent = '';

    if (coachName === '') {
        document.getElementById('removeCoachNameError').textContent = 'Coach name is required';
        isValid = false;
    } else if (!/^[a-zA-Z\s]+$/.test(coachName)) {
        document.getElementById('removeCoachNameError').textContent = 'Coach name must contain only letters';
        isValid = false;
    }

    if (isValid) {
        // Send the form data to the server using fetch
        await fetch('/auth/removecoach', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ removeCoachName: coachName })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                console.log('Server response:', data);
                document.getElementById('removeCoachSuccessMessage').textContent = 'Coach Removed';
                coachNameInput.value = '';
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    return isValid;
}

// Remove Product Form Validation
function validateremoveProductForm() {
    const productNameInput = document.getElementById('removeProductName');
    const productName = productNameInput.value.trim();
    let isValid = true;

    document.getElementById('removeProductNameError').textContent = '';

    if (productName === '') {
        document.getElementById('removeProductNameError').textContent = 'Product name is required';
        isValid = false;
    } else if (!/^[a-zA-Z\s]+$/.test(productName)) {
        document.getElementById('removeProductNameError').textContent = 'Product name must contain only letters';
        isValid = false;
    }

    if (isValid) {
        productNameInput.value = '';
        document.getElementById('removeProductSuccessMessage').textContent = 'Product Removed';
    }

    return isValid;
}

function validateEditProductForm() {
    const editProductNameInput = document.getElementById('editProductName');
    const newProductNameInput = document.getElementById('newProductName');
    const editProductName = editProductNameInput.value.trim();
    const newProductName = newProductNameInput.value.trim();
    let isValid = true;

    document.getElementById('editProductNameError').textContent = '';
    document.getElementById('newProductNameError').textContent = '';
    document.getElementById('editProductSuccessMessage').textContent = '';

    if (editProductName === '') {
        document.getElementById('editProductNameError').textContent = 'Product name is required';
        isValid = false;
    } else if (!/^[a-zA-Z]+$/.test(editProductName)) {
        document.getElementById('editProductNameError').textContent = 'Product name must contain only letters';
        isValid = false;
    }

    if (newProductName === '') {
        document.getElementById('newProductNameError').textContent = 'New name is required';
        isValid = false;
    } else if (!/^[a-zA-Z]+$/.test(newProductName)) {
        document.getElementById('newProductNameError').textContent = 'New name must contain only letters';
        isValid = false;
    } else if (newProductName.toLowerCase() === editProductName.toLowerCase()) {
        document.getElementById('newProductNameError').textContent = 'New name must be different from the product name';
        isValid = false;
    }

    if (isValid) {
        editProductNameInput.value = '';
        newProductNameInput.value = '';
        document.getElementById('editProductSuccessMessage').textContent = 'Edited Successfully';
    }

    return isValid;
}


let ingredientIndex = 1;
function addIngredient() {
    const container = document.getElementById('ingredientsContainer');
    const newIngredientGroup = document.createElement('div');
    newIngredientGroup.className = 'ingredient-group';
    newIngredientGroup.innerHTML = `
        <input type="text" name="ingredients[${ingredientIndex}][name]" placeholder="Ingredient Name" required>
        <input type="text" name="ingredients[${ingredientIndex}][quantity]" placeholder="Quantity" required>
        <button type="button"   class="remove-button" onclick="removeIngredient(this)">-</button>
    `;
    container.appendChild(newIngredientGroup);
    ingredientIndex++;
}

function removeIngredient(button) {
    const container = document.getElementById('ingredientsContainer');
    container.removeChild(button.parentElement);
}

let newIngredientIndex = 1;
function addNewIngredient() {
    const container = document.getElementById('newIngredientsContainer');
    const newIngredientGroup = document.createElement('div');
    newIngredientGroup.className = 'ingredient-group';
    newIngredientGroup.innerHTML = `
        <input type="text" name="newIngredients[${newIngredientIndex}][name]" placeholder="Ingredient Name" required>
        <input type="text" name="newIngredients[${newIngredientIndex}][quantity]" placeholder="Quantity" required>
        <button type="button"   class="remove-button" onclick="removeNewIngredient(this)">-</button>
    `;
    container.appendChild(newIngredientGroup);
    newIngredientIndex++;
}

function removeNewIngredient(button) {
    const container = document.getElementById('newIngredientsContainer');
    container.removeChild(button.parentElement);
}




function toggleStatsContainer() {
    const statsContainer = document.getElementById('stats_Container');

    if (isStatsContainerMiddle) {
        statsContainer.classList.remove('middle');
        isStatsContainerMiddle = false;
        isStatsContainerRight = false;
    } else if (isStatsContainerRight) {
        statsContainer.classList.remove('right');
        statsContainer.classList.add('middle');
        isStatsContainerMiddle = true;
    } else {
        statsContainer.classList.add('right');
        isStatsContainerRight = true;
    }
}



document.addEventListener('DOMContentLoaded', function () {
    const isDarkMode = localStorage.getItem('darkModeEnabled') === 'true';
    const darkModeButton = document.querySelector('.darkmode-button');

    if (isDarkMode) {
        document.body.classList.add('dark-mode');
        darkModeButton.textContent = 'Light Mode';
    } else {
        document.body.classList.remove('dark-mode');
        darkModeButton.textContent = 'Dark Mode';
    }
});