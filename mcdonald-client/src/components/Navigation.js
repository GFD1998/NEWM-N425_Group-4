import { NavLink } from 'react-router-dom';
import NavStyles from '../pages/styles/nav.module.css';
import Signin from "../pages/auth/signin";
import Signout from "../pages/auth/signout";
import Signup from "../pages/auth/signup";
import {settings} from "../config/config";
import useXmlHttp from '../services/useXmlHttp';
import {useParams} from "react-router-dom";
// import './class.css';
import {useAuth} from "../services/useAuth";

const Navigation = () => {
  const {isAuthed, user} = useAuth();
  return (
    <>
      <nav>
            <NavLink to="/" className={NavStyles.navLinks}>HOME</NavLink>
            <NavLink to="/menuitems" className={NavStyles.navLinks}>MENU ITEMS</NavLink>
            <NavLink to="/allergen" className={NavStyles.navLinks}>ALLERGENS</NavLink>
            <NavLink to="/ingredients" className={NavStyles.navLinks}>INGREDIENTS</NavLink>
            <NavLink to="/nutritionalinformation" className={NavStyles.navLinks}>NUTRITIONAL INFORMATION</NavLink>
              {isAuthed
                  ? <NavLink to="/signout"className={NavStyles.navLinks}>SIGN OUT</NavLink>
                  : <NavLink to="/signin"className={NavStyles.navLinks}>SIGN IN</NavLink>
              }
      </nav>
    </>
  );
}

export default Navigation;
