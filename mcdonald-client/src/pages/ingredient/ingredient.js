import {settings} from "../../config/config";
import {NavLink, Outlet, useLocation} from "react-router-dom";
import {useState, useEffect} from "react";
import useXmlHttp from "../../services/useXmlHttp";
import {useAuth} from "../../services/useAuth";
import MenuStyles from "../styles/menu.module.css";
const Ingredient = () => {
    const {user} = useAuth();
    const {pathname} = useLocation();
    const [subHeading, setSubHeading] = useState("All Ingredients");
    const url = settings.baseApiUrl + "/ingredient";

    const {
        error,
        isLoading,
        data: ingredient
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

    useEffect(() => {
        setSubHeading("All Ingredients");
    }, [pathname]);
    return (
       <>
           <div className="main-heading">
               <div className="container">Ingredients</div>
           </div>
           <div className="sub-heading">
               <div className="container">Welcome to the Ingredients Dashboard</div>
           </div>
           <div className="main-content container">
                
           </div>
       </>
   );
};

export default Ingredient;
