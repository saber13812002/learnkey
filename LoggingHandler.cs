﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using System.Web;

namespace MvcApp_irib_spClass
{

    public class LoggingHandler : DelegatingHandler
    {
        protected override Task<HttpResponseMessage> SendAsync(HttpRequestMessage request, CancellationToken cancellationToken)
        {
            // Log the request information
            LogRequestLoggingInfo(request);

            // Execute the request
            return base.SendAsync(request, cancellationToken).ContinueWith(task =>
            {
                var response = task.Result;
                // Extract the response logging info then persist the information
                LogResponseLoggingInfo(response);
                return response;
            });
        }

        private void LogRequestLoggingInfo(HttpRequestMessage request)
        {
            if (request.Content != null)
            {
                request.Content.ReadAsByteArrayAsync()
                    .ContinueWith(task =>
                    {
                        var result = Encoding.UTF8.GetString(task.Result);
                        // Log it somewhere
                    }).Wait(); // !!! Here is the fix !!!
            }
        }

        private void LogResponseLoggingInfo(HttpResponseMessage response)
        {
            if (response.Content != null)
            {
                response.Content.ReadAsByteArrayAsync()
                    .ContinueWith(task =>
                    {
                        var responseMsg = Encoding.UTF8.GetString(task.Result);
                        // Log it somewhere
                    });
            }
        }
    }


    //public class LoggingHandler : DelegatingHandler
    //{
    //    protected override Task<HttpResponseMessage> SendAsync(HttpRequestMessage request, CancellationToken cancellationToken)
    //    {
    //        LogRequest(request);

    //        return base.SendAsync(request, cancellationToken).ContinueWith(task =>
    //        {
    //            var response = task.Result;

    //            LogResponse(response);

    //            return response;
    //        });
    //    }

    //    private void LogRequest(HttpRequestMessage request)
    //    {
    //        (request.Content ?? new StringContent("")).ReadAsStringAsync().ContinueWith(x =>
    //        {
    //            Logger.Info("{4:yyyy-MM-dd HH:mm:ss} {5} {0} request [{1}]{2} - {3}", request.GetCorrelationId(), request.Method, request.RequestUri, x.Result, DateTime.Now, Username(request));
    //        });
    //    }

    //    private void LogResponse(HttpResponseMessage response)
    //    {
    //        var request = response.RequestMessage;
    //        (response.Content ?? new StringContent("")).ReadAsStringAsync().ContinueWith(x =>
    //        {
    //            Logger.Info("{3:yyyy-MM-dd HH:mm:ss} {4} {0} response [{1}] - {2}", request.GetCorrelationId(), response.StatusCode, x.Result, DateTime.Now, Username(request));
    //        });
    //    }

    //    private string Username(HttpRequestMessage request)
    //    {
    //        var values = new List<string>().AsEnumerable();
    //        if (request.Headers.TryGetValues("my-custom-header-for-current-user", out values) == false) return "<anonymous>";

    //        return values.First();
    //    }
    //}
}