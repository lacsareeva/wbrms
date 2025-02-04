import './bootstrap';

//Search Function onkeypress
function filterTable() {
    const input = document.getElementById('search');
    const filter = input.value.toLowerCase();
    let totalRowCount = 0;
    let visibleRowCount = 0;
    let totalRowCounts = 0;
    let visibleRowCounts = 0;
    let totalRowCountss = 0;
    let visibleRowCountss = 0;
    let totalRowCountsss = 0;
    let visibleRowCountsss = 0;

    const visibleContainers = document.querySelectorAll('.container');

    visibleContainers.forEach(container => {

        if (container.style.display !== 'none') {
            const table = container.querySelector('table');
            if (table) {
                const rows = table.getElementsByTagName('tr');
                let containerRowCount = 0;
                let containerVisibleCount = 0;
                let containerRowCounts = 0;
                let containerVisibleCounts = 0;
                let containerRowCountss = 0;
                let containerVisibleCountss = 0;
                let containerRowCountsss = 0;
                let containerVisibleCountsss = 0;
                const noDataRow = table.querySelector('#noDataRow');

                for (let i = 1; i < rows.length; i++) {
                    const row = rows[i];
                    const cells = row.getElementsByTagName('td');
                    let match = false;

                    if (row.id === 'noDataRow') continue;

                    containerRowCount++;
                    containerRowCounts++;
                    containerRowCountss++;
                    containerRowCountsss++;
                    for (let j = 0; j < cells.length; j++) {
                        if (cells[j]) {
                            const cellValue = cells[j].textContent || cells[j].innerText;
                            if (cellValue.toLowerCase().includes(filter)) {
                                match = true;
                                break;
                            }
                        }
                    }

                    if (match) {
                        row.style.display = '';
                        containerVisibleCount++;
                        containerVisibleCounts++;
                        containerVisibleCountss++;
                        containerVisibleCountsss++;
                    } else {
                        row.style.display = 'none';
                    }
                }

                if (noDataRow) {
                    noDataRow.style.display = containerVisibleCount === 0 ? '' : 'none';
                    noDataRow.style.display = containerVisibleCounts === 0 ? '' : 'none';
                    noDataRow.style.display = containerVisibleCountss === 0 ? '' : 'none';
                    noDataRow.style.display = containerVisibleCountsss === 0 ? '' : 'none';

                }
                totalRowCount += containerRowCount;
                visibleRowCount += containerVisibleCount;
                totalRowCounts += containerRowCounts;
                visibleRowCounts += containerVisibleCounts;
                totalRowCountss += containerRowCountss;
                visibleRowCountss += containerVisibleCountss;
                totalRowCountsss += containerRowCountsss;
                visibleRowCountsss += containerVisibleCountsss;
            }
        }
    });

    const countValue = document.getElementById('countValue');
    countValue.textContent = `${visibleRowCount} of ${totalRowCount}`;
    const countValues = document.getElementById('countValues');
    countValues.textContent = `${visibleRowCounts} of ${totalRowCounts}`;
    const countValuess = document.getElementById('countValuess');
    countValuess.textContent = `${visibleRowCountss} of ${totalRowCountss}`;
    const countValuesss = document.getElementById('countValue1');
    countValuesss.textContent = `${visibleRowCountsss} of ${totalRowCountsss}`;
}
window.filterTable = filterTable;

//Search Function button click
function searchReport(){
    const input = document.getElementById('search');
    const filter = input.value.toLowerCase().trim();
    let totalRowCount = 0;
    let visibleRowCount = 0;
    let totalRowCounts = 0;
    let visibleRowCounts = 0;
    let totalRowCountss = 0;
    let visibleRowCountss = 0;
    let totalRowCountsss = 0;
    let visibleRowCountsss = 0;

    const visibleContainers = document.querySelectorAll('.container');

    visibleContainers.forEach(container => {
        if (container.style.display !== 'none') {
            const table = container.querySelector('table');
            if (table) {
                const rows = table.getElementsByTagName('tr');
                let containerRowCount = 0;
                let containerVisibleCount = 0;
                let containerRowCounts = 0;
                let containerVisibleCounts = 0;
                let containerRowCountss = 0;
                let containerVisibleCountss = 0;
                let containerRowCountsss = 0;
                let containerVisibleCountsss = 0;
                const noDataRow = table.querySelector('#noDataRow');

                for (let i = 1; i < rows.length; i++) {
                    const row = rows[i];
                    const cells = row.getElementsByTagName('td');
                    let match = false;

                    if (row.id === 'noDataRow') continue;

                    containerRowCount++; 
                    containerRowCounts++;
                    containerRowCountss++;
                    containerRowCountsss++;

                    for (let j = 0; j < cells.length; j++) {
                        const cellValue = cells[j].textContent || cells[j].innerText;
                        if (cellValue.toLowerCase().trim() === filter) {
                            match = true;
                            break;
                        }
                    }

                    if (match) {
                        row.style.display = ''; 
                        containerVisibleCount++; 
                        containerVisibleCounts++;
                        containerVisibleCountss++;
                        containerVisibleCountsss++;
                    } else {
                        row.style.display = 'none'; 
                    }
                }

                if (noDataRow) {
                    noDataRow.style.display = containerVisibleCount === 0 ? '' : 'none';
                    noDataRow.style.display = containerVisibleCounts === 0 ? '' : 'none';
                    noDataRow.style.display = containerVisibleCountss === 0 ? '' : 'none';
                    noDataRow.style.display = containerVisibleCountsss=== 0 ? '' : 'none';
                }

                totalRowCount += containerRowCount; 
                visibleRowCount += containerVisibleCount;
                totalRowCounts += containerRowCounts;
                visibleRowCounts += containerVisibleCounts;
                totalRowCountss += containerRowCountss;
                visibleRowCountss += containerVisibleCountss;
                totalRowCountsss += containerRowCountsss;
                visibleRowCountsss += containerVisibleCountsss;
            }
        }
    });

    // Update the visible row count globally
    const countValue = document.getElementById('countValue');
    if (countValue) countValue.textContent = `${visibleRowCount} of ${totalRowCount}`;
    const countValues = document.getElementById('countValues');
    countValues.textContent = `${visibleRowCounts} of ${totalRowCounts}`;
    const countValuess = document.getElementById('countValuess');
    countValuess.textContent = `${visibleRowCountss} of ${totalRowCountss}`;
    const countValuesss = document.getElementById('countValue1');
    countValuesss.textContent = `${visibleRowCountsss} of ${totalRowCountsss}`;
}
window.searchReport = searchReport;

//---------------------------

// Show Contaianer Funtion 
function showSection(sectionId) {
    document.querySelectorAll('.container').forEach(container => {
        container.style.display = 'none';
    });
    document.getElementById(sectionId).style.display = 'block';

    const buttons = document.querySelectorAll('.report-btn button');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    switch (sectionId) {
        case 'requestContainer':
            document.getElementById('requestBtn').classList.add('active');
            filterTable();
            break;
        case 'borrowContainer':
            document.getElementById('borrowBtn').classList.add('active');
            filterTable();
            break;
        case 'blotterContainer':
            document.getElementById('blotterBtn').classList.add('active');
            filterTable();
            break;
        case 'accountsContainer':
            document.getElementById('accountsBtn').classList.add('active');
            filterTable();
            break;
        case 'announcementContainer':
            document.getElementById('announcementBtn').classList.add('active');
            filterTable();
            break;
    }
}
window.showSection = showSection;
// -------------------------

// Funtion for Converting HTML table to PDF(AnnoucementContainer)
const pdf_btn = document.querySelector('#toPDF');
const announcementContainer = document.querySelector('#announcementContainer');

const getCurrentDateTime = () => {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    let hours = now.getHours();
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12;
    return `Date: ${year}-${month}-${day} Time: ${hours.toString().padStart(2, '0')}:${minutes} ${ampm}`;
};

const toPDF = function (announcementContainer) {
    const currentDateTime = getCurrentDateTime();
    const html_code = `
    <!DOCTYPE html>
    <html>
    <head>
        <title>Announcement Report</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
                -webkit-print-color-adjust: exact;
            }
            h2 {
                text-align: center;
                padding-bottom: 10px;
            }
            hr {
                margin: 10px 0;
            }
            #datetime {
                font-weight: bold;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table,
            th,
            td {
                border: 1px solid #ccc;
            }
            th,
            td {
                padding: 12px;
                text-align: center;
            }
            th {
                background-color: #008C63;
                color: white;
            }
            .print-button{
                display:none;
            }
        </style>
    </head>
    <body>
        <div style="font-weight: bold">Name: ${userName}</div>
        <div style="font-weight: bold">Email: ${userEmail}</div>
        <div id="datetime">${currentDateTime}</div>
        <hr>
        <main>${announcementContainer.innerHTML}</main>
    </body>
    </html>
    `;

    const new_window = window.open();
    new_window.document.write(html_code);

    setTimeout(() => {
        new_window.print();
        new_window.close();
    }, 400);
};
pdf_btn.onclick = () => {
    toPDF(announcementContainer);
};
//----------------------------------------------------------

// Funtion for Converting HTML table to PDF(blotterContainer)
const pdf_btn2 = document.querySelector('#blotter_toPDF');
const blotterContainer = document.querySelector('#blotterContainer');

const blotter_toPDF = function (blotterContainer) {
    const currentDateTime = getCurrentDateTime();
    const html_code = `
    <!DOCTYPE html>
    <html>
    <head>
        <title>Blotter Report</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
                -webkit-print-color-adjust: exact;
            }
            h2 {
                text-align: center;
                padding-bottom: 10px;
            }
            hr {
                margin: 10px 0;
            }
            #datetime {
                font-weight: bold;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table,
            th,
            td {
                border: 1px solid #ccc;
            }
            th,
            td {
                padding: 12px;
                text-align: center;
            }
            th {
                background-color: #008C63;
                color: white;
            }
            .print-button{
                display:none;
            }
        </style>
    </head>
    <body>
        <div style="font-weight: bold">Name: ${userName}</div>
        <div style="font-weight: bold">Email: ${userEmail}</div>
        <div id="datetime">${currentDateTime}</div>
        <hr>
        <main>${blotterContainer.innerHTML}</main>
    </body>
    </html>
    `;

    const new_window = window.open();
    new_window.document.write(html_code);

    setTimeout(() => {
        new_window.print();
        new_window.close();
    }, 400);
};
pdf_btn2.onclick = () => {
    blotter_toPDF(blotterContainer);
};
// -------------------------

// Funtion for Converting HTML table to PDF(borrowContainer)
const pdf_btn3 = document.querySelector('#borrow_toPDF');
const borrowContainer = document.querySelector('#borrowContainer');

const borrowed_toPDF = function (borrowContainer) {
    const currentDateTime = getCurrentDateTime();
    const html_code = `
    <!DOCTYPE html>
    <html>
    <head>
        <title>Borrowed Equipment Report</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
                -webkit-print-color-adjust: exact;
            }
            h2 {
                text-align: center;
                padding-bottom: 10px;
            }
            hr {
                margin: 10px 0;
            }
            #datetime {
                font-weight: bold;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table,
            th,
            td {
                border: 1px solid #ccc;
            }
            th,
            td {
                padding: 12px;
                text-align: center;
            }
            th {
                background-color: #008C63;
                color: white;
            }
            .print-button{
                display:none;
            }
        </style>
    </head>
    <body>
        <div style="font-weight: bold">Name: ${userName}</div>
        <div style="font-weight: bold">Email: ${userEmail}</div>
        <div id="datetime">${currentDateTime}</div>
        <hr>
        <main>${borrowContainer.innerHTML}</main>
    </body>
    </html>
    `;

    const new_window = window.open();
    new_window.document.write(html_code);

    setTimeout(() => {
        new_window.print();
        new_window.close();
    }, 400);
};
pdf_btn3.onclick = () => {
    borrowed_toPDF(borrowContainer);
};
// -------------------------

// Funtion for Converting HTML table to PDF(accountsContainer)
const pdf_btn4 = document.querySelector('#account_toPDF');
const accountContainer = document.querySelector('#accountsContainer');

const account_toPDF = function (accountContainer) {
    const currentDateTime = getCurrentDateTime();
    const html_code = `
    <!DOCTYPE html>
    <html>
    <head>
        <title>Account's List Report</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
                -webkit-print-color-adjust: exact;
            }
            h2 {
                text-align: center;
                padding-bottom: 10px;
            }
            hr {
                margin: 10px 0;
            }
            #datetime {
                font-weight: bold;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table,
            th,
            td {
                border: 1px solid #ccc;
            }
            th,
            td {
                padding: 12px;
                text-align: center;
            }
            th {
                background-color: #008C63;
                color: white;
            }
            .print-button{
                display:none;
            }
        </style>
    </head>
    <body>
        <div style="font-weight: bold">Name: ${userName}</div>
        <div style="font-weight: bold">Email: ${userEmail}</div>
        <div id="datetime">${currentDateTime}</div>
        <hr>
        <main>${accountContainer.innerHTML}</main>
    </body>
    </html>
    `;

    const new_window = window.open();
    new_window.document.write(html_code);

    setTimeout(() => {
        new_window.print();
        new_window.close();
    }, 400);
};
pdf_btn4.onclick = () => {
    account_toPDF(accountContainer);
};
// -------------------------

// Funtion for Converting HTML table to PDF(requestContainer)
const pdf_btn5 = document.querySelector('#request_toPDF');
const requestContainer = document.querySelector('#requestContainer');

const request_toPDF = function (requestContainer) {
    const currentDateTime = getCurrentDateTime();
    const html_code = `
    <!DOCTYPE html>
    <html>
    <head>
        <title>Request Document List Report</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
                -webkit-print-color-adjust: exact;
            }
            h2 {
                text-align: center;
                padding-bottom: 10px;
            }
            hr {
                margin: 10px 0;
            }
            #datetime {
                font-weight: bold;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table,
            th,
            td {
                border: 1px solid #ccc;
            }
            th,
            td {
                padding: 12px;
                text-align: center;
            }
            th {
                background-color: #008C63;
                color: white;
            }
            .print-button{
                display:none;
            }
        </style>
    </head>
    <body>
        <div style="font-weight: bold">Name: ${userName}</div>
        <div style="font-weight: bold">Email: ${userEmail}</div>
        <div id="datetime">${currentDateTime}</div>
        <hr>
        <main>${requestContainer.innerHTML}</main>
    </body>
    </html>
    `;

    const new_window = window.open();
    new_window.document.write(html_code);

    setTimeout(() => {
        new_window.print();
        new_window.close();
    }, 400);
};
pdf_btn5.onclick = () => {
    request_toPDF(requestContainer);
};