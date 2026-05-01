class MyFooter extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <footer class="footer">
                <div class="footer-wrapper">
                    <div class="orange">
                        <p>COOK GO!</p>
                    </div>
                    <div class="down-title">
                        <p>Готовьте с нами</p>
                    </div>
                    <div class="foot-img">
                        <img src="../images/ui/foot_l.png" alt="footer icon">
                    </div>
                </div>
            </footer>`;
    }
}
customElements.define('my-footer', MyFooter);