import FooterStyles from '../pages/styles/footer.module.css';


const Footer = () => {
    const year = new Date().getFullYear();
    return (
        <>
            <footer>
                <div>
                    <span>&copy;McDonald's Corporation. 1955-{year}</span>
                </div>
            </footer>
        </>
    );
};

export default Footer;