import {settings} from "../../config/config";
import {NavLink, Outlet, useLocation} from "react-router-dom";
import {useState, useEffect} from "react";
import "../styles/menu.module.css";
import './menuitem.css';
import useXmlHttp from "../../services/useXmlHttp";
import {useAuth} from "../../services/useAuth";

const MenuItems = () => {
    const {user} = useAuth();
    const {pathname} = useLocation();
    const [subHeading, setSubHeading] = useState("All Menu Items");
    const url = settings.baseApiUrl + "/menuitems";

    const {
        error,
        isLoading,
        data: menuitems
    } = useXmlHttp(url, "GET", {Authorization:`Bearer ${user.jwt}`});

    useEffect(() => {
        setSubHeading("All Menu Items");
    }, [pathname]);

    return (
        <>
            <div className="main-heading">
                <div className="container">Menu</div>
            </div>
            <div className="sub-heading">
                <div className="container">{subHeading}</div>
            </div>
            <div className="main-content container">
                {/* {error && <div>{error}</div>} */}
                {isLoading &&
                    <div className="image-loading">
                        Please wait while data is being loaded
                        <img src={require(`../loading.gif`)} alt="Loading ......"/>
                </div>}
                {menuitems && <div className="menuitem-container">
                    <div className="menuitem-list">
                        {console.log(menuitems.data)}
                        {menuitems.data.map((menuitem) => (
                            
                            <NavLink key={menuitem.itemID}
                                     className={({isActive}) => isActive ? "active" : ""}
                                     to={`/menuitems/${menuitem.itemID}`}>
                                <span>&nbsp;</span><div>{menuitem.name}</div>
                            </NavLink>
                        ))}
                    </div>
                    <div className="menuitem">
                        <Outlet context={[subHeading, setSubHeading]}/>
                    </div>
                        </div>}
            </div>
        </>
    );
};

export default MenuItems;
