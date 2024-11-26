import Swiper from "swiper/bundle";
window.Swiper = Swiper

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("nav-account-link").addEventListener("click", function () {
        var ul = this.closest("li").querySelector("ul");
        if (ul.classList.contains('hidden')) {
            ul.classList.add("flex")
            ul.classList.remove("hidden")
        }
        else {
            ul.classList.remove("flex")
            ul.classList.add("hidden")
        }
    })
    document.querySelectorAll("#add_to_cart[data-product-id]").forEach(element => {
        element.addEventListener("click", function () {
            fetch("/cart", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'url': '/payment',
                    "X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    id: element.getAttribute("data-product-id"),
                    quantity: element.parentElement.querySelector("input[type='number']") ? element.parentElement.querySelector("input[type='number']").value : 1
                })
            }).then(res => res.json())
                .then(data => {
                    document.querySelector("header #cart_count").innerHTML = data.cart_count;
                    document.querySelector("header #cart_count").classList.add("animationjs");
                    setTimeout(() => {
                        document.querySelector("header #cart_count").classList.remove("animationjs");
                    }, 1000);
                });
        })
    });
})

let cities = [{ "state": "Béni Mellal-Khénifra", "province": "Azilal" }, { "state": "Béni Mellal-Khénifra", "province": "Béni-Mellal" }, { "state": "Béni Mellal-Khénifra", "province": "Fquih Ben Salah" }, { "state": "Béni Mellal-Khénifra", "province": "Khénifra" }, { "state": "Béni Mellal-Khénifra", "province": "Khouribga" }, { "state": "Casablanca-Settat", "province": "Benslimane" }, { "state": "Casablanca-Settat", "province": "Berrechid" }, { "state": "Casablanca-Settat", "province": "Casablanca" }, { "state": "Casablanca-Settat", "province": "El Jadida" }, { "state": "Casablanca-Settat", "province": "Médiouna" }, { "state": "Casablanca-Settat", "province": "Mohammedia" }, { "state": "Casablanca-Settat", "province": "Nouaceur" }, { "state": "Casablanca-Settat", "province": "Settat" }, { "state": "Casablanca-Settat", "province": "Sidi Bennour" }, { "state": "Dakhla-Oued Ed-Dahab", "province": "Aousserd" }, { "state": "Dakhla-Oued Ed-Dahab", "province": "Oued Ed-Dahab" }, { "state": "Drâa-Tafilalet", "province": "Errachidia" }, { "state": "Drâa-Tafilalet", "province": "Midelt" }, { "state": "Drâa-Tafilalet", "province": "Ouarzazate" }, { "state": "Drâa-Tafilalet", "province": "Tinghir" }, { "state": "Drâa-Tafilalet", "province": "Zagora" }, { "state": "Fès-Meknès", "province": "Boulemane" }, { "state": "Fès-Meknès", "province": "El Hajeb" }, { "state": "Fès-Meknès", "province": "Fez" }, { "state": "Fès-Meknès", "province": "Ifrane" }, { "state": "Fès-Meknès", "province": "Meknès" }, { "state": "Fès-Meknès", "province": "Moulay Yacoub" }, { "state": "Fès-Meknès", "province": "Sefrou" }, { "state": "Fès-Meknès", "province": "Taounate" }, { "state": "Fès-Meknès", "province": "Taza" }, { "state": "Guelmim-Oued Noun", "province": "Assa-Zag" }, { "state": "Guelmim-Oued Noun", "province": "Guelmim" }, { "state": "Guelmim-Oued Noun", "province": "Sidi Ifni" }, { "state": "Guelmim-Oued Noun", "province": "Tan-Tan" }, { "state": "Laâyoune-Sakia El Hamra", "province": "Boujdour" }, { "state": "Laâyoune-Sakia El Hamra", "province": "Es Semara" }, { "state": "Laâyoune-Sakia El Hamra", "province": "Laâyoune" }, { "state": "Laâyoune-Sakia El Hamra", "province": "Tarfaya" }, { "state": "Marrakesh-Safi", "province": "Al Haouz" }, { "state": "Marrakesh-Safi", "province": "Chichaoua" }, { "state": "Marrakesh-Safi", "province": "El Kelâa des Sraghna" }, { "state": "Marrakesh-Safi", "province": "Essaouira" }, { "state": "Marrakesh-Safi", "province": "Marrakesh" }, { "state": "Marrakesh-Safi", "province": "Rehamna" }, { "state": "Marrakesh-Safi", "province": "Safi" }, { "state": "Marrakesh-Safi", "province": "Youssoufia" }, { "state": "Oriental", "province": "Berkane" }, { "state": "Oriental", "province": "Driouch" }, { "state": "Oriental", "province": "Figuig" }, { "state": "Oriental", "province": "Guercif" }, { "state": "Oriental", "province": "Jerada" }, { "state": "Oriental", "province": "Nador" }, { "state": "Oriental", "province": "Oujda-Angad" }, { "state": "Oriental", "province": "Taourirt" }, { "state": "Rabat-Salé-Kénitra", "province": "Kénitra" }, { "state": "Rabat-Salé-Kénitra", "province": "Khémisset" }, { "state": "Rabat-Salé-Kénitra", "province": "Rabat" }, { "state": "Rabat-Salé-Kénitra", "province": "Salé" }, { "state": "Rabat-Salé-Kénitra", "province": "Sidi Kacem" }, { "state": "Rabat-Salé-Kénitra", "province": "Sidi Slimane" }, { "state": "Rabat-Salé-Kénitra", "province": "Skhirate-Témara" }, { "state": "Souss-Massa", "province": "Agadir-Ida Ou Tanane" }, { "state": "Souss-Massa", "province": "Chtouka Aït Baha" }, { "state": "Souss-Massa", "province": "Inezgane-Aït Melloul" }, { "state": "Souss-Massa", "province": "Taroudant" }, { "state": "Souss-Massa", "province": "Tata" }, { "state": "Souss-Massa", "province": "Tiznit" }, { "state": "Tanger-Tetouan-Al Hoceima", "province": "Al Hoceïma" }, { "state": "Tanger-Tetouan-Al Hoceima", "province": "Chefchaouen" }, { "state": "Tanger-Tetouan-Al Hoceima", "province": "Fahs-Anjra" }, { "state": "Tanger-Tetouan-Al Hoceima", "province": "Larache" }, { "state": "Tanger-Tetouan-Al Hoceima", "province": "M'diq-Fnideq" }, { "state": "Tanger-Tetouan-Al Hoceima", "province": "Ouezzane" }, { "state": "Tanger-Tetouan-Al Hoceima", "province": "Tangier-Assilah" }, { "state": "Tanger-Tetouan-Al Hoceima", "province": "Tétouan" }];
((e, f, g) => { if (e) { e.addEventListener("change", () => { f.innerHTML = g + cities.filter(r => r.state == e.value).map(r => `<option value="${r.province}">${r.province}</option>`).join("") }) } })(document.querySelector("select#state[name='state']"), document.querySelector("select#city[name='city']"), `<option value="" disabled selected hidden>-- Select a City --</option>`)
