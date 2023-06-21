import {settings} from "../../config/config";
import {NavLink, Outlet, useLocation} from "react-router-dom";
import {useState, useEffect} from "react";
import "../styles/menu.module.css";
import './nutritionalinformation.css';
import useXmlHttp from "../../services/useXmlHttp";
import {useAuth} from "../../services/useAuth";
import UseFetch from "../../services/useFetch";
import JSONPretty from 'react-json-pretty';

const NutritionalInformations = () => {
    const {user} = useAuth();
    const {pathname} = useLocation();
    const {data: menuitems, getAll, search} = UseFetch();
    const [subHeading, setSubHeading] = useState("All Nutritional Information");
    const url = settings.baseApiUrl + "/nutritionalinformation";

    // const mi = get();


    // console.log(mi);
    // console.log(url);

    // async function getMenuItems(){
    //     const mi = await fetch(settings.baseApiUrl + "/menuitems");
    //     return mi.json();
    // }
    // const MI = getMenuItems();
    // var MIData = MI.then((r) => {
    //     return r.data;
    // });

    // console.log(MIData);



    const {
        error,
        isLoading,
        data: nutritionalinformations
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
                <div className="container">{subHeading}</div>
            </div>
            <div className="main-content container">
                {/* {error && <div>{error}</div>} */}
                {isLoading &&
                    <div className="image-loading">
                        Please wait while data is being loaded
                        <img src={require(`../loading.gif`)} alt="Loading ......"/>
                </div>}
                {nutritionalinformations && <div className="nutritionalinformation-container">
                    <div className="nutritionalinformation-list">
                    {/* {console.log(nutritionalinformations.data)} */}
                        {nutritionalinformations.data.map((nutritionalinformation) => (
                            
                            <NavLink key={nutritionalinformation.nutritionalinformationID}
                                     className={({isActive}) => isActive ? "active" : ""}
                                     to={`/nutritionalinformations/${nutritionalinformation.nutritionalInformationID}`}>
                                <span>&nbsp;</span><div>{nutritionalinformation.itemID}</div>
                            </NavLink>
                        ))}
                    </div>
                    <div className="nutritionalinformation">
                        <Outlet context={[subHeading, setSubHeading]}/>
                    </div>
                        </div>}
            </div>
        </>
    );
};

export default NutritionalInformations;