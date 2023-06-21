import {NavLink} from "react-router-dom";
import {Navbar, Nav, Container} from "react-bootstrap";
import logo from '../pages/mcdonaldsLogo.png';

//This component creates a React-Bootstrap navbar. https://react-bootstrap.github.io/components/navbar/
const Header = () => {
    const className = ({ isActive }) => isActive ? "nav-link active" : "nav-link";
    return (
        <>
            <Navbar bg="primary" variant="dark" expand="sm">
                <Container>
                    <NavLink to="/">
                        <Navbar.Brand><img src={logo} alt="Logo"/>MyCollege</Navbar.Brand>
                    </NavLink>
                    <Navbar.Toggle aria-controls="basic-navbar-nav" />
                    <Navbar.Collapse id="basic-navbar-nav">
                        <Nav className="me-auto">
                            <NavLink to="/" className={className}>Home</NavLink>
							<div className="nav-separator">|</div>
                            <NavLink to="/professors" className={className}>Professor</NavLink>
                        </Nav>
                    </Navbar.Collapse>
                </Container>
            </Navbar>
        </>
    );
}

export default Header;