import {settings} from "../../config/config";
import {NavLink, Outlet, useLocation} from "react-router-dom";
import {useState, useEffect} from "react";
import useXmlHttp from "../../services/useXmlHttp";
import {useAuth} from "../../services/useAuth";
import MenuStyles from "../styles/menu.module.css";
const NutritionalInformation = () => {
    const {user} = useAuth();
    const {pathname} = useLocation();
    const [subHeading, setSubHeading] = useState("All Nutritional Information");
    const url = settings.baseApiUrl + "/nutritionalinformation";

    const {
        error,
        isLoading,
        data: nutritionalinformation
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

    useEffect(() => {
        setSubHeading("All Nutritional Information");
    }, [pathname]);
    return (
       <>
           <div className="main-heading">
               <div className="container">Nutritional Information</div>
           </div>
           <div className="sub-heading">
               <div className="container">Welcome to the Nutritional Information Dashboard</div>
           </div>
           <div className="main-content container">
                
           </div>
       </>
   );
};

export default NutritionalInformation;
