using System;
using System.Collections.Generic;
using System.Linq;
using System.Web.Http;

namespace MvcApp_irib_spClass
{
    public static class WebApiConfig
    {
        public static void Register(HttpConfiguration config)
        {
            config.Routes.MapHttpRoute(
                name: "DefaultApi",
                routeTemplate: "learnkey/{controller}/{id1}",
                defaults: new { id1 = RouteParameter.Optional }
            );


            config.Routes.MapHttpRoute(
                name: "DefaultApi2",
                routeTemplate: "learnkey/{controller}/{id1}/{page}",
                defaults: new { id1 = RouteParameter.Optional, page = RouteParameter.Optional }
            );

            config.Routes.MapHttpRoute(
                name: "DefaultApi3",
                routeTemplate: "learnkey/{controller}/{Code}/{Title}/{Type}/{Date}/{VisitCount}/{GpsLat}/{GpsLit}/{Pics}/{tok}",
                //string Code, string Title, string Type, string Date, string VisitCount, string GpsLat, string GpsLit,string Pics, string tok
                defaults: new { Code = RouteParameter.Optional, Title = RouteParameter.Optional, Type = RouteParameter.Optional, Date = RouteParameter.Optional, VisitCount = RouteParameter.Optional, GpsLat = RouteParameter.Optional, GpsLit = RouteParameter.Optional, Pics = RouteParameter.Optional, tok = RouteParameter.Optional }
            );


            var json = config.Formatters.JsonFormatter;
            json.SerializerSettings.PreserveReferencesHandling = Newtonsoft.Json.PreserveReferencesHandling.Objects;
            config.Formatters.Remove(config.Formatters.XmlFormatter);

        }
    }
}
