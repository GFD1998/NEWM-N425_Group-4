import {settings} from "../../config/config";
import {NavLink, Outlet, useLocation} from "react-router-dom";
import {useState, useEffect} from "react";
import useXmlHttp from "../../services/useXmlHttp";
import {useAuth} from "../../services/useAuth";
import MenuStyles from "../styles/menu.module.css";

const Allergen = () => {
    const {user} = useAuth();
    const {pathname} = useLocation();
    const [subHeading, setSubHeading] = useState("All Allergens");
    const url = settings.baseApiUrl + "/allergen";

    const {
        error,
        isLoading,
        data: allergens
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

    useEffect(() => {
        setSubHeading("All Allergens");
    }, [pathname]);
    return (
       <>
           <div className="main-heading">
               <div className="container">Allergens</div>
           </div>
           <div className="sub-heading">
               <div className="container">Welcome to the Allergens Dashboard</div>
           </div>
           <div className="main-content container">
                
           </div>
       </>
   );
};

export default Allergen;
