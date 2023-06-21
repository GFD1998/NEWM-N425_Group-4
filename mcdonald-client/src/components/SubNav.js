import { NavLink } from 'react-router-dom';
import NavStyles from '../pages/styles/nav.module.css';
import Search from "./Search";
import Create from "./Create";
import Update from "./Update";
import Delete from "./Delete";
import {settings} from "../config/config";
import useXmlHttp from '../services/useXmlHttp';
import {useParams} from "react-router-dom";
// import './class.css';
import {useAuth} from "../services/useAuth";

const Navigation = (item) => {
  const {isAuthed, user} = useAuth();
  return (
    <>
      <nav>
            <NavLink to={"/" + item} className={NavStyles.navLinks}>HOME</NavLink>
            <NavLink to={"/" + item} className={NavStyles.navLinks}>SEARCH</NavLink>
            <NavLink to={"/" + item} className={NavStyles.navLinks}>CREATE</NavLink>
            <NavLink to={"/" + item} className={NavStyles.navLinks}>UPDATE</NavLink>
            <NavLink to={"/" + item} className={NavStyles.navLinks}>DELETE</NavLink>
              {useAuth.isAuthed
                  ? <NavLink to="/signout"className={NavStyles.navLinks}>SIGN OUT</NavLink>
                  : <NavLink to="/signin"className={NavStyles.navLinks}>SIGN IN</NavLink>
              }
      </nav>
    </>
  );
}

export default Navigation;
