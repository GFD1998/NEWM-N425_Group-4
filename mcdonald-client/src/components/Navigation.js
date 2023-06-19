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

  
  return (
    <>
      <nav>
            <NavLink to="/" className={NavStyles.navLinks}>HOME</NavLink>
            <NavLink to="/menuitem" className={NavStyles.navLinks}>MENU ITEM</NavLink>
            <NavLink to="/allergen" className={NavStyles.navLinks}>ALLERGENS</NavLink>
            <NavLink to="/ingredient" className={NavStyles.navLinks}>INGREDIENTS</NavLink>
            <NavLink to="/nutritionalinformation" className={NavStyles.navLinks}>NUTRITIONAL INFORMATION</NavLink>
            <div className="nav-separator">|</div>
              {useAuth.isAuthed
                  ? <NavLink to="/signout">Sign out</NavLink>
                  : <NavLink to="/signin">Sign in/Sign up</NavLink>
              }
      </nav>
    </>
  );
}

export default Navigation;