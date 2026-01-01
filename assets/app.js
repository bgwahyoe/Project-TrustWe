document.addEventListener("DOMContentLoaded", () => {
  const links = document.querySelectorAll("a");

  links.forEach(link => {
    if (link.href === window.location.href) {
      link.classList.add("active");
    }
  });
});

function simpanTransaksi() {
  const nama = document.getElementById("nama").value;
  const jumlah = document.getElementById("jumlah").value;

  if (!nama || !jumlah) {
    alert("Data tidak boleh kosong!");
    return;
  }

  const transaksi = JSON.parse(localStorage.getItem("transaksi")) || [];
  transaksi.push({ nama, jumlah });

  localStorage.setItem("transaksi", JSON.stringify(transaksi));
  tampilkanTransaksi();
}

function tampilkanTransaksi() {
  const list = document.getElementById("listTransaksi");
  if (!list) return;

  list.innerHTML = "";
  const transaksi = JSON.parse(localStorage.getItem("transaksi")) || [];

  transaksi.forEach(t => {
    const li = document.createElement("li");
    li.textContent = `${t.nama} - Rp ${t.jumlah}`;
    list.appendChild(li);
  });
}

document.addEventListener("DOMContentLoaded", tampilkanTransaksi);

function hitungTotal() {
  const transaksi = JSON.parse(localStorage.getItem("transaksi")) || [];
  let total = 0;

  transaksi.forEach(t => {
    total += parseInt(t.jumlah);
  });

  const el = document.getElementById("total");
  if (el) el.textContent = "Rp " + total;
}

document.addEventListener("DOMContentLoaded", hitungTotal);

function toggleMode() {
  document.body.classList.toggle("dark");

  localStorage.setItem(
    "theme",
    document.body.classList.contains("dark") ? "dark" : "light"
  );
}

document.addEventListener("DOMContentLoaded", () => {
  const theme = localStorage.getItem("theme");
  if (theme === "dark") {
    document.body.classList.add("dark");
  }
});
