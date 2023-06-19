import {settings} from "../../config/config";
import {NavLink, Outlet, useLocation} from "react-router-dom";
import {useState, useEffect} from "react";
import useXmlHttp from "../../services/useXmlHttp";
import {useAuth} from "../../services/useAuth";
import MenuStyles from "../styles/menu.module.css";

const MenuItem = () => {
    const {user} = useAuth();
    const {pathname} = useLocation();
    const [subHeading, setSubHeading] = useState("All Menu Items");
    const url = settings.baseApiUrl + "/menuitem";
    const {
        error,
        isLoading,
        data: menuitem
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

    useEffect(() => {
        setSubHeading("All Menu Items");
    }, [pathname]);
    async function menuitems(){
        const mi = await fetch("http://localhost/projects/NEWM-N425_Group-4/api/v1/menuitems").then(res => res.json()).then(json => console.log(JSON.stringify(json)));
        // console.log(mi);
        return mi;
    }
    const muJson = menuitems();
    console.log(muJson["totalCount"]);
    return (
       <>
           <div className="main-heading">
               <div className="container">Menu Item</div>
           </div>
           <div className="sub-heading">
               <div className="container">Welcome to the McDonald's Dashboard</div>
           </div>
           <div className={MenuStyles.menuContainer}>
                <ul className={MenuStyles.menuList}>
                    <li className={MenuStyles.menuItem}>
                        <div className={MenuStyles.menuInput}>
                            <input type="text" placeholder="Choose element to delete..."/>
                            <select class="form-select" aria-label="Default select example">

                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </li>
                </ul>
           </div>
       </>
   );
};

export default MenuItem;
