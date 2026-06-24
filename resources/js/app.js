import './bootstrap';
import 'flowbite';
import { DataTable } from "simple-datatables";
import Alpine from 'alpinejs';

window.DataTable = DataTable;
window.simpleDatatables = { DataTable };
window.Alpine = Alpine;

function initDataTable(tableId, loaderSelector) {
    const tableEl = document.getElementById(tableId);
    const loaderEl = document.querySelector(loaderSelector);

    if (!tableEl || typeof DataTable === 'undefined') return;

    const dataTable = new DataTable(tableEl, {
        paging: true,
        perPage: 10,
        searchable: true,
        sortable: true,
        numeric: true,
        labels: {
            placeholder: "Cari data...",
            searchTitle: "Cari data di tabel",
            pageTitle: "Halaman {page}",
            perPage: "",
            noRows: "Belum ada data",
            info: "Menampilkan {start} sampai {end} dari {rows} data",
            noResults: "Tidak ditemukan data yang sama",
        },
    });

    const rebindFlowbite = () => {
        document.querySelectorAll('[data-modal-toggle]').forEach(el => {
            const newEl = el.cloneNode(true);
            el.parentNode.replaceChild(newEl, el);
        });

        if (typeof window.initFlowbite === 'function') {
            window.initFlowbite();
        }
    };

    dataTable.on('datatable.page', rebindFlowbite);
    dataTable.on('datatable.update', rebindFlowbite);
    dataTable.on('datatable.sort', rebindFlowbite);

    if (loaderEl) loaderEl.style.display = "none";
    tableEl.style.display = "table";

    rebindFlowbite();
}

document.addEventListener('DOMContentLoaded', () => {
    initDataTable('myTable', '#loader');
    initDataTable('myTable2', '#loader2');
});

Alpine.start();