const searchDataInput = document.getElementById("searchData");
const tableRows = document.querySelectorAll(".data-table tbody tr");

const tableHeaders = document.querySelectorAll("th");



if(searchDataInput) {
        searchDataInput.addEventListener("input", () => {
        
        const searchValue = searchDataInput.value.trim().toLowerCase();

        tableRows.forEach((row) => {
            const rowText = row.textContent.toLowerCase();
            row.hidden = !rowText.includes(searchValue);
        });

    });
}


function sortTable(columnIndex) {
    const table = document.querySelector("table");
    const tbody = table.tBodies[0];
    const rows = Array.from(tbody.rows);

    rows.sort((rowA, rowB) => {
        const valueA = rowA.cells[columnIndex].textContent.trim();
        const valueB = rowB.cells[columnIndex].textContent.trim();
        if (columnIndex === 3) {
            return Number(valueA) - Number(valueB);
        }
        return valueA.localeCompare(valueB, "pl", {
            sensitivity: "base"
        })
    });

    rows.forEach((row) => {
        tbody.appendChild(row);
    });

}

tableHeaders.forEach((header, index) => {
    header.addEventListener("click", () => {
        sortTable(index);
    });
});

const registerForm = document.querySelector(".register-form");
const loginForm = document.querySelector(".login-form");
const registerButton = document.getElementById("registerBtn");
const loginButton = document.getElementById("loginBtn");

function changeForm() {
    if(loginForm.style.display != "none") {
        loginForm.style.display = "none";
        registerForm.style.display = "block";
    }
    else {
        registerForm.style.display = "none";
        loginForm.style.display = "block";
    }
};

registerButton.addEventListener("click", () => {
    changeForm();
});

loginButton.addEventListener("click", () => {
    changeForm();
});



